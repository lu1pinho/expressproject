<?php
session_start();
define('CAMINHO_IMAGENS', '../produtos/');

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include '../settings/connection.php';
include '../model/PedidosRealizadosModel.php';

$id_user = $_SESSION['id'];
$model = new CartModel($conn);
$produtos = $model->getProductsInCart($id_user);

$conn->close();
include'../view\pedidos_realizados.php';