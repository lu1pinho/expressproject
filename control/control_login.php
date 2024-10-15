<?php
session_start();
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
include '../model/login.php';

class LoginController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
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

        $usuario = $this->userModel->findUserByEmailAndPassword($email, $password);

        if ($usuario) {
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            header("Location: control_pagina-principal.php");
            exit();
        } else {
            return "Falha ao logar! Nome de usuário ou senha incorretos";
        }
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
