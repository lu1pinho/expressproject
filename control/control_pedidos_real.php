<?php
session_start(); // Inicie a sessão no início

// Verifique se o user_id está definido na sessão
/*if (!isset($_SESSION['user_id'])) {
    // Redirecione para a página de login
    header("Location: /expressproject/view/login.php");
    exit(); // Garanta que o script pare de executar após o redirecionamento
}*/

$user_id = $_SESSION['user_id']; // Acesse o user_id da sessão

// Inclua a conexão com o banco de dados
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

// Inclua o modelo
include '../model/pedidos_realizados.php';

// Busque os pedidos do usuário
$pedidos = getPedidosByUserId($conn, $user_id);

// Inclua a view
include '../view/pedidos_realizados.php';
?>