<?php
session_start();
include '../settings/connection.php'; // Conexão com o banco de dados
include '../model/atualizar-vendedor.php';


class AtualizarCadastroController {
    private $model;

    public function __construct($conn) {
        $this->model = new AtualizarCadastroModel($conn);
    }

    // Carregar os dados do usuário na página de atualização
    public function loadUserData($userId) {
        return $this->model->getUserById($userId);
    }

    // Método para processar a atualização do cadastro
    public function atualizarCadastro($userId, $email, $categoria, $senha) {
        // Verificar se a senha está correta
        if ($this->model->verifyPasswordById($userId, $senha)) {
            // Atualizar a categoria e o email
            if ($this->model->updateUserCategory($userId, $email, $categoria)) {
               // echo "Categoria e email atualizados com sucesso!<br>";

                // Verificar se a categoria foi alterada para 'fornecedor'
                if ($categoria === 'fornecedor') {
                    // Se a categoria for "fornecedor", redireciona para a página do vendedor
                    header("Location: ../control/control_pagina-vendedor.php?success=1");
                    exit();
                } else {
                    // Se a categoria ainda for diferente de 'fornecedor', exibe o alerta e impede o redirecionamento
                    echo "<script>alert('Você precisa atualizar sua categoria para fornecedor!');</script>";
                }
            } else {
                echo "Erro ao atualizar a categoria ou email.<br>";
            }
        } else {
            // Senha incorreta
            header("Location: ../control/control_atualizar-vendedor.php?error=invalid_password");
            exit();
        }
    }
}

// Verificar se o usuário está autenticado
if (!isset($_SESSION['id'])) {
    echo "Usuário não autenticado. <a href='login.php'>Clique aqui para fazer login.</a>";
    exit();
}

$userId = $_SESSION['id'];
$controller = new AtualizarCadastroController($conn);

// Verificar se o formulário foi enviado
if (isset($_POST['atualizar'])) {
    $email = $_POST['email'];
    $categoria = $_POST['category'];
    $senha = $_POST['senha'];

    // Verificar se os dados estão sendo capturados corretamente
   // echo "Dados recebidos do formulário:<br>";
    //echo "Email: $email, Categoria: $categoria, Senha: $senha<br>";

    // Processar a atualização
    $erro = $controller->atualizarCadastro($userId, $email, $categoria, $senha);
}

// Carregar dados do usuário para a view
$userData = $controller->loadUserData($userId);
$email = $userData['email'] ?? '';  // Garantir que $email tenha um valor padrão
$categoria = $userData['categoria'] ?? 'cliente'; // Garantir que $categoria tenha um valor padrão

// Incluir a view
include '../view/atualizar-vendedor.php';
?>
