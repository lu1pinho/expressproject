<?php
session_start();

include '../settings/connection.php';
include '../model/atualizar-produto.php';

define('CAMINHO_IMAGENS', '/expressproject/view/produtos'); // Definição do caminho das imagens

if ($conn->connect_error) {
    die("Erro: A conexão com o banco de dados não foi estabelecida.");
}

if (!isset($_SESSION['id'])) {
    header("Location: ../control/control_login.php");
    exit();
}

$vendedor_id = $_SESSION['id'];
$productModel = new ProductModel($conn);

// Lógica para exclusão de produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];

    // Tentar excluir o produto
    if ($productModel->deleteProduct($delete_id, $vendedor_id)) {
        // Redirecionar após exclusão bem-sucedida
        header("Location: ../control/control_pagina-vendedor.php");
        exit();
    } else {
        echo "Erro ao excluir o produto.";
        exit();
    }
}

// Lógica para edição de produto
$produto_id = null;
if (isset($_GET['id'])) {
    $produto_id = (int)$_GET['id'];
} elseif (isset($_POST['id'])) {
    $produto_id = (int)$_POST['id'];
}

if ($produto_id) {
    $produto = $productModel->getProductByIdAndSeller($produto_id, $vendedor_id);

    if (!$produto) {
        echo "Produto não encontrado ou você não tem permissão para editar este produto.";
        exit();
    }
} else {
    echo "ID do produto não especificado.";
    exit();
}

// Atualizar produto se o formulário de edição for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $dados_produto = $_POST['dados_produto'];
    $preco = (float)$_POST['preco'];
    $preco_com_desconto = (float)$_POST['preco_com_desconto'];
    $frete_gratis = isset($_POST['frete_gratis']) ? 1 : 0;
    $categoria = $_POST['categoria'];
    $oferta_do_dia = isset($_POST['oferta_do_dia']) ? 1 : 0;
    $estoque = (int)$_POST['estoque'];
    $frete = $_POST['frete'];

    $productModel->updateProduct($id, $vendedor_id, $nome, $descricao, $dados_produto, $preco, $preco_com_desconto, $frete_gratis, $categoria, $oferta_do_dia, $estoque, $frete);

    // Redirecionar após a atualização
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $id);
    exit();
}

include '../view/atualizar_produto.php';
?>
