<?php
include 'C:/xampp/htdocs/expressproject/settings/connection.php';
include '../model/pagamento.php';

session_start();
$id_usuario = $_SESSION['id'];

$pedidoModel = new PedidoModel($conn);

$endereco = $pedidoModel->buscarCepUsuario($id_usuario);
$frete = 0;
if ($endereco) {
    $frete = $pedidoModel->calcularFrete($endereco['cep']);
}

$produtos = $pedidoModel->buscarProdutosCarrinho($id_usuario);
$total_produtos = 0;
foreach ($produtos as $produto) {
    $produto_nome = $produto['produto_nome'];
    $url_img = $produto['url_img'];
    $preco = $produto['preco'];
    $preco_com_desconto = $produto['preco_com_desconto'];
    $quantidade = $produto['quantidade'];
    $preco_final = $preco_com_desconto ?: $preco;
    $total_produtos += $preco_final * $quantidade;
}

$cartoes = $pedidoModel->buscarCartoesUsuario($id_usuario);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comprar'])) {

    foreach ($produtos as $produto) {
        $preco = $produto['preco'];
        $preco_com_desconto = $produto['preco_com_desconto'];
        $quantidade = $produto['quantidade'];
        $url_img = $produto['url_img']; 
        $produto_nome = $produto['produto_nome']; 

        $preco_final = $preco_com_desconto ?: $preco;
        $total_produtos += $preco_final * $quantidade;

        $pedidoModel->inserirProdutosComprados($id_usuario, $produto_nome, $quantidade, $preco_final, $url_img);
    }

    $pedidoModel->excluirProdutosCarrinho($id_usuario);

    header("Location: /expressproject/control/control_pagina-principal.php");
    exit();
}

$conn->close();

include '../view/pagamento.php';
