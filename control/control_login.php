<?php
session_start();
include 'C:\xampp\htdocs\expressproject\settings\connection.php';

// Definindo o tipo de resposta como JSON
header('Content-Type: application/json');

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Log para diagnóstico dos dados recebidos
    error_log(print_r($_POST, true)); // Loga os dados recebidos do frontend

    // Verifica se o email ou a senha estão vazios
    if (empty($email) || empty($senha)) {
        echo json_encode(['status' => 'error', 'message' => 'Preencha todos os campos.']);
        exit();
    }

    // Prepara a consulta para verificar o usuário e senha no banco
    $stmt = $conn->prepare("SELECT id, nome, categoria, enderecos.cep FROM users LEFT JOIN enderecos ON users.id = enderecos.id_user WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verifica se o usuário foi encontrado
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Armazena os dados do usuário na sessão
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['categoria'] = $user['categoria'];
        $_SESSION['cep'] = $user['cep'] ?? 'Não informado'; // Armazena o CEP (se não for NULL, caso contrário "Não informado")

        // Retorna sucesso e a URL de redirecionamento
        echo json_encode(['status' => 'success', 'redirect' => '/expressproject/control/control_pagina-principal.php']);
    } else {
        // Se o login falhar
        echo json_encode(['status' => 'error', 'message' => 'Credenciais inválidas.']);
    }

    // Fecha o statement
    $stmt->close();
    exit();
} else {
    // Caso o método não seja POST
    echo json_encode(['status' => 'error', 'message' => 'Método não suportado.']);
}
