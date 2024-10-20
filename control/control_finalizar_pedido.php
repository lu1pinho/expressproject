<?php
session_start();
include 'C:/xampp/htdocs/expressproject/settings/connection.php'; 
include '../model/finalizar_compra.php';

if (!isset($_SESSION['id'])) {
    header('Location: C:/xampp/htdocs/expressproject/control/control_login.php'); 
    exit();
}

$id_user = $_SESSION['id'];
$enderecoModel = new EnderecoModel($conn); 

if (isset($_GET['action']) && $_GET['action'] == 'voltar') {
    if ($enderecoModel->excluirProdutosCarrinho($id_user)) {
        header('Location: ../control/control_carrinho.php');
        exit();
    } else {
        echo "Erro ao tentar excluir os produtos do carrinho.";
    }
}

$endereco = $enderecoModel->buscarEnderecoPorUsuario($id_user);

if ($endereco) {
    $enderecoCompleto = htmlspecialchars("{$endereco['endereco']} {$endereco['numero']}, {$endereco['bairro']} - {$endereco['cidade']}, {$endereco['estado']}");
    $frete = $enderecoModel->calcularFrete($endereco['cep']);
} else {
    $erro = "Endereço não encontrado para este usuário.";
}

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

$conn->close();

include '../view/finalizar_compra.php';
