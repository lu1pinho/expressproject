<?php
session_start();

/*if (!isset($_SESSION['user_id'])) {
    header("Location: /expressproject/view/login.php");
    exit();
}*/

$user_id = $_SESSION['user_id'];

include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
include '../model/pedidos_realizados.php';
include '../view/pedidos_realizados.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comprar'])) {
    $produtosCarrinho = $_POST['produtos']; 

    $pedido_id = criarPedido($conn, $user_id);

    foreach ($produtosCarrinho as $produto) {
        adicionarProdutoAoPedido($conn, $pedido_id, $produto['id'], $produto['quantidade']);
    }

    header("Location: /expressproject/view/pedidos_realizados.php");
    exit();
}
?>