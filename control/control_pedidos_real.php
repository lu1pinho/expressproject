<?php

include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
include '../model\pedidos_realizados.php';

session_start();

// Verificar se o usuário está logado
/*if (!isset($_SESSION['user_id'])) {
    // Redirecionar para a página de login se não estiver logado
    header("Location: C:/xampp/htdocs/expressproject/view/dados_usuarios/login.php");
    exit();
}*/

$userId = $_SESSION['user_id'];

// Buscar os pedidos do usuário
$pedidos = getPedidosByUserId($pdo, $userId);

// Incluir a view para exibir os dados
include '../view\pedidos_realizados.php';
?>