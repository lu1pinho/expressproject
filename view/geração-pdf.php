<?php
// Incluir a biblioteca FPDF
require('../fpdf/fpdf.php');
include 'C:/xampp/htdocs/expressproject/settings/connection.php'; // Caminho para sua conexão
include '../model/pagamento.php';

// Configuração para evitar mensagens de erro no output do PDF
ini_set('display_errors', 0);
error_reporting(0);

// Obter o id_usuario da sessão
session_start();
$id_usuario = $_SESSION['id'];

// Criar um novo objeto PedidoModel
$pedidoModel = new PedidoModel($conn);

// Buscar os produtos comprados do usuário na tabela produtos_comprados
$sql = "SELECT pc.produto_nome, pc.quantidade, pc.preco, pc.data_compra, pc.id_produto, pc.codigo, p.vendedor_id 
        FROM produtos_comprados pc
        JOIN produtos p ON pc.id_produto = p.id
        WHERE pc.id_user = ?";

$stmt = $conn->prepare($sql);

// Verificar se a preparação da consulta falhou
if (!$stmt) {
    die("Erro ao preparar a consulta SQL: " . $conn->error);
}

$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Criar o objeto FPDF
$pdf = new FPDF();
$pdf->AddPage();

// Caminho para a imagem
$imagemPath = 'C:\xampp\htdocs\expressproject\fotos\logo.png';

// Adicionar a imagem no cabeçalho, por exemplo, no canto superior esquerdo
$pdf->Image($imagemPath, 10, 5, 20);  // X = 10, Y = 10, Largura = 30


// Cabeçalho da nota fiscal
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, utf8_decode('Nota Fiscal de Compra'), 0, 1, 'C');
$pdf->Ln(10);

// Dados do pedido
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(95, 10, utf8_decode('Produto'), 1, 0, 'C');
$pdf->Cell(20, 10, utf8_decode('Qtd'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Preço Unitário'), 1, 0, 'C');
$pdf->Cell(30, 10, utf8_decode('Total'), 1, 1, 'C');

// Preencher a tabela com os produtos
$pdf->SetFont('Arial', '', 12);
$totalPedido = 0;
$codigoPedido = 'Não informado'; // Padrão caso não seja definido no loop

while ($produto = $result->fetch_assoc()) {
    $subtotal = $produto['quantidade'] * $produto['preco'];
    $totalPedido += $subtotal;
    $codigoPedido = isset($produto['codigo']) ? $produto['codigo'] : 'Não informado';

    // Buscar os dados do vendedor para o produto atual
    $vendedor_id = $produto['vendedor_id'];
    $vendedor = $pedidoModel->buscarDadosVendedor($vendedor_id);

    // Salva a posição inicial da linha
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // Nome do produto com quebra de linha
    $pdf->MultiCell(95, 10, utf8_decode($produto['produto_nome']), 1, 'L');

    // Ajusta a posição inicial para as próximas colunas
    $cellHeight = $pdf->GetY() - $y; // Calcula a altura da célula com base no texto
    $pdf->SetXY($x + 95, $y); // Move para a próxima coluna
    $pdf->Cell(20, $cellHeight, $produto['quantidade'], 1, 0, 'C');
    $pdf->Cell(30, $cellHeight, utf8_decode('R$ ' . number_format($produto['preco'], 2, ',', '.')), 1, 0, 'C');
    $pdf->Cell(30, $cellHeight, utf8_decode('R$ ' . number_format($subtotal, 2, ',', '.')), 1, 1, 'C');

    // Adiciona os dados do vendedor para o produto
    if ($vendedor) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(95, 10, utf8_decode('Vendedor: ' . $vendedor['nome']), 0, 1, 'L');
        $pdf->Cell(95, 10, utf8_decode('E-mail: ' . $vendedor['email']), 0, 1, 'L');
        $pdf->Cell(95, 10, utf8_decode('Telefone: ' . $vendedor['telefone']), 0, 1, 'L');
        $pdf->Ln(3); // Adiciona um pequeno espaçamento
    }
}

// Exibir o total do pedido
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(145, 10, utf8_decode('Total'), 1, 0, 'R');
$pdf->Cell(30, 10, utf8_decode('R$ ' . number_format($totalPedido, 2, ',', '.')), 1, 1, 'C');

// Adicionar o código do pedido no final
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, utf8_decode('Código do Pedido: ' . $codigoPedido), 0, 1, 'L');

// Exibir o PDF no navegador
$pdf->Output();

$conn->close();
