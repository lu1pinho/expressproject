<?php
include 'C:/xampp/htdocs/expressproject/settings/connection.php';
include '../model/pagamento.php';

session_start();
$id_usuario = $_SESSION['id'];

$pedidoModel = new PedidoModel($conn);

// Buscar o endereço e calcular o frete
$endereco = $pedidoModel->buscarCepUsuario($id_usuario);
$frete = 0;
if ($endereco) {
    $frete = $pedidoModel->calcularFrete($endereco['cep']);
}

// Buscar produtos do carrinho
$produtos = $pedidoModel->buscarProdutosCarrinho($id_usuario);
$total_produtos = 0;
foreach ($produtos as $produto) {
    $preco = $produto['preco'];
    $preco_com_desconto = $produto['preco_com_desconto'];
    $quantidade = $produto['quantidade'];
    $preco_final = $preco_com_desconto ?: $preco;
    $total_produtos += $preco_final * $quantidade;
}

// Buscar cartões do usuário
$cartoes = $pedidoModel->buscarCartoesUsuario($id_usuario);

$conn->close();

// Passar dados para a view
include '../view/pagamento.php';
