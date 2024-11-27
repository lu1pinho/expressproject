<?php
session_start();
include 'C:\xampp\htdocs\expressproject\settings\connection.php';
include '../model/login.php';

class LoginController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para exibir a página de login
    public function showLoginPage($errorMessage = null) {
        include '../view/login.php';
    }

    // Método para processar o login
    public function login($email, $password) {
        if (empty($email)) {
            return "Preencha seu email";
        } elseif (empty($password)) {
            return "Preencha sua senha";
        }

        // Consulta ao banco para buscar o usuário e o CEP
        $sql = "
            SELECT 
                users.id AS id,
                users.nome AS nome,
                enderecos.cep AS cep
            FROM users
            LEFT JOIN enderecos ON users.id = enderecos.id_user
            WHERE users.email = ? AND users.senha = ?
        ";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro na preparação da consulta: " . $this->conn->error);
        }

        // Vincula os parâmetros e executa
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();

        // Vincula os resultados às variáveis
        $stmt->bind_result($id, $nome, $cep);

        // Verifica se há resultados e salva na sessão
        if ($stmt->fetch()) {
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['cep'] = $cep ?? 'Não informado'; // Trata caso o CEP seja NULL
            
            // Redireciona para a página principal
            header("Location: control_pagina-principal.php");
            exit();
        } else {
            return "Falha ao logar! Nome de usuário ou senha incorretos.";
        }

        // Fecha o statement
        $stmt->close();
    }
}

// Verifica se o formulário foi submetido ou se deve exibir a página de login
$controller = new LoginController($conn);

if (isset($_POST['submit'])) {
    // Se o formulário for enviado, processa o login
    $errorMessage = $controller->login($_POST['email'], $_POST['password']);
    $controller->showLoginPage($errorMessage);
} else {
    // Caso contrário, exibe a página de login
    $controller->showLoginPage();
}
?>
