<?php
session_start();
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
include '../model/login.php';

class LoginController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new UserModel($conn);
    }

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
            header("Location:../newsource/paginas/principal/pagina.php");
            exit();
        } else {
            echo  "<script>alert('Falha ao logar! Nome de usuário ou senha incorretos');</script>";

            header("Location:../view/login.html");

        }
    }
}

if (isset($_POST['submit'])) {
    $controller = new LoginController($conn);
    $errorMessage = $controller->login($_POST['email'], $_POST['password']);
}
?>
