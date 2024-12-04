<?php
include_once '../settings/connection.php';
include_once '../model/CadastroModel.php';
include_once '../view/cadastro.html';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validação dos campos
    $errors = [];

    if (strlen($_POST['name']) == 0) {
        $errors[] = "Preencha seu nome.";
    }
    if (strlen($_POST['phone']) == 0) {
        $errors[] = "Preencha seu telefone.";
    }
    if (strlen($_POST['category']) == 0) {
        $errors[] = "Selecione uma categoria.";
    }
    if (strlen($_POST['email']) == 0) {
        $errors[] = "Preencha seu email.";
    }
    if (strlen($_POST['password']) == 0) {
        $errors[] = "Preencha sua senha.";
    }
    if (strlen($_POST['confirm-password']) == 0) {
        $errors[] = "Confirme sua senha.";
    }
    if ($_POST['password'] !== $_POST['confirm-password']) {
        $errors[] = "As senhas não coincidem.";
    }

    if (empty($errors)) {
        // Escapando os dados
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $category = $conn->real_escape_string($_POST['category']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']); // Armazenando a senha diretamente

        // Criando instância do modelo
        $userModel = new \Model\CadastroModel($conn);

        // Verifica se o email já está cadastrado
        if ($userModel->checkEmailExists($email)) {
            echo "<script>alert('Este email já está cadastrado.');</script>";
        } else {
            // Insere o usuário no banco
            if ($userModel->createUser($name, $phone, $category, $email, $password)) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                header('Location: /expressproject/view/view/logins\login.php'); // Redireciona para a página principal
                exit();
            } else {
                echo "Erro ao cadastrar: " . $conn->error;
            }
        }
    } else {
        // Exibindo as mensagens de erro
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}
?>



/expressproject/view/view/logins\login.php