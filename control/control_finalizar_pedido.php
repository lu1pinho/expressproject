<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('C:\xampp\htdocs\expressproject\control\control_login.php');
    exit();
}

include 'C:/xampp/htdocs/expressproject/settings/connection.php'; // Inclui a conexão
include '../model/finalizar_compra.php';

$id_user = $_SESSION['id'];

$enderecoModel = new EnderecoModel($conn); // Usa a conexão existente

// Obtém o endereço do usuário
$endereco = $enderecoModel->buscarEnderecoPorUsuario($id_user);

if ($endereco) {
    $enderecoCompleto = htmlspecialchars("{$endereco['endereco']} {$endereco['numero']}, {$endereco['bairro']} - {$endereco['cidade']}, {$endereco['estado']}");
    $frete = $enderecoModel->calcularFrete($endereco['cep']);
} else {
    $erro = "Endereço não encontrado para este usuário.";
}

// Obtém os produtos no carrinho
$produtos = $enderecoModel->buscarProdutosCarrinho($id_user);
$total_produtos = 0;
$itens_carrinho = [];

if ($produtos->num_rows > 0) {
    while ($row = $produtos->fetch_assoc()) {
        $preco = $row['preco_com_desconto'] ?: $row['preco'];
        $total_item = $preco * $row['quantidade'];
        $total_produtos += $total_item;
        $itens_carrinho[] = $row;
    }
}

// Fecha a conexão com o banco
$conn->close();

// Carrega a view
include '../view/finalizar_compra.php';
