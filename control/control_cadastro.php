<?php
include_once '../settings/connection.php';
include_once '../model/cadastro.php';
include_once '../view/cadastro.html';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação dos campos
    if (strlen($_POST['name']) == 0) {
        echo "Preencha seu nome";
    } else if (strlen($_POST['phone']) == 0) {
        echo "Preencha seu telefone";
    } else if (strlen($_POST['category']) == 0) {
        echo "Selecione uma categoria";
    } else if (strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if (strlen($_POST['password']) == 0) {
        echo "Preencha sua senha";
    } else if (strlen($_POST['confirm-password']) == 0) {
        echo "Confirme sua senha";
    } else if ($_POST['password'] !== $_POST['confirm-password']) {
        echo "As senhas não coincidem";
    } else {
        // Escapando os dados
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $category = $conn->real_escape_string($_POST['category']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        // Criando instância do modelo
        $userModel = new UserModel($conn);

        // Verifica se o email já está cadastrado
        if ($userModel->checkEmailExists($email)) {
            echo "<script>alert('Este email já está cadastrado.');</script>";
        } else {
            // Insere o usuário no banco
            if ($userModel->createUser($name, $phone, $category, $email, $password)) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            } else {
                echo "Erro ao cadastrar: " . $conn->error;
            }
        }
    }
}
?>