<?php
session_start();
include '../settings/connection.php'; // Conexão com o banco de dados
include '../settings/config.php';
include '../model/pagina-vendedor.php'; // Modelo da página do vendedor

// Verifica se o usuário está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: ..control/control_login.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}

// Pega o ID do vendedor logado a partir da sessão
$vendedor_id = $_SESSION['id']; // id do vendedor logado

// Busca os produtos cadastrados pelo vendedor logado
$query = "SELECT * FROM produtos WHERE vendedor_id = ?"; // Corrigido para usar vendedor_id
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $vendedor_id); // Passa o id do vendedor logado para a consulta
$stmt->execute();
$result_produtos = $stmt->get_result();

// Verifica se encontrou produtos
$produtos = [];
if ($result_produtos->num_rows > 0) {
    while ($produto = $result_produtos->fetch_assoc()) {
        $produtos[] = $produto; // Armazena cada produto em um array
    }
}

// Inclui a view da página do vendedor, passando os produtos encontrados
include '../view/pagina-vendedor.php';
?>
