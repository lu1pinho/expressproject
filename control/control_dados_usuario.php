<?php
include '../model/dados_usuario.php';
// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Redireciona para a página de login se não estiver autenticado
    exit;
}

// A variável $userId já está definida no model
$userId = $_SESSION['id'];

// Aqui você pode executar a lógica de atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['atualizar'])) {
        // Coletando os dados do POST e executando as funções de atualização
        // O model já está tratando a atualização e retorno dos dados
        // Você pode adicionar lógica de feedback aqui, se necessário
    }
}

// Dados do usuário, endereço e cartão são carregados do model
// O model retorna as variáveis necessárias que serão usadas na view

include '../view/dados_usuario.php';
?>
