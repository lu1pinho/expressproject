<?php
session_start();
include '../settings/connection.php';
include '../model/atualizar-produto.php';

if ($conn->connect_error) {
    die("Erro: A conexão com o banco de dados não foi estabelecida.");
}

if (!isset($_SESSION['id'])) {
    header("Location: ../control/control_login.php");
    exit();
}

$vendedor_id = $_SESSION['id'];
$productModel = new ProductModel($conn);

// Verifica se o ID do produto foi passado via GET
if (isset($_GET['id'])) {
    $produto_id = (int)$_GET['id'];

    // Busca o produto específico do vendedor
    $produto = $productModel->getProductByIdAndSeller($produto_id, $vendedor_id);

    if (!$produto) {
        echo "Produto não encontrado ou você não tem permissão para editar este produto.";
        exit();
    }
} else {
    echo "ID do produto não especificado.";
    exit();
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $dados_produto = $_POST['dados_produto'];
    $preco = $_POST['preco'];
    $preco_com_desconto = $_POST['preco_com_desconto'];
    $frete_gratis = isset($_POST['frete_gratis']) ? 1 : 0;
    $categoria = $_POST['categoria'];
    $oferta_do_dia = isset($_POST['oferta_do_dia']) ? 1 : 0;
    $estoque = $_POST['estoque'];
    $frete = $_POST['frete'];

    $productModel->updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete);

    header("Location: ../control/control_pagina-vendedor.php");
    exit();
}

include '../view/atualizar_produto.php';