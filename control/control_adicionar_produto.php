<?php
session_start(); // Adicione esta linha para iniciar a sessão
// Incluindo os arquivos necessários
include 'C:\xampp\htdocs\expressproject\settings\connection.php';
include '../model/adicionar_produto.php';
include '../view/adicionar_produto.php';


// Verifica se o usuário está autenticado
if (!isset($_SESSION['id'])) {
    header("Location: ../control/control_login.php"); // Redireciona para a página de login se não estiver autenticado
    exit();
}


// Pega o ID do vendedor logado (a partir da sessão)
$vendedor_id = $_SESSION['id']; // Ou $_SESSION['id'], dependendo de como você armazenou o ID na sessão


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: exibe o conteúdo do array $_FILES
    //var_dump($_FILES); // Adicione aqui


    // Validação dos campos
    if (strlen($_POST['name']) == 0) {
        echo "Preencha o nome do produto";
    } else if (strlen($_POST['descricao']) == 0) {
        echo "Preencha a descrição do produto";
    } else if (strlen($_POST['category']) == 0) {
        echo "Selecione uma categoria";
    } else if (strlen($_POST['preco']) == 0) {
        echo "Preencha o preço do produto";
    } else if (strlen($_POST['estoque']) == 0) {
        echo "Informe a quantidade em estoque";
    } else if (strlen($_POST['dados_produto']) == 0) {
        echo "Informe os dados do produto";
    } else if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] != 0) {
        echo "Insira uma imagem válida";
    } else {
        // Escapando os dados
        $name = $conn->real_escape_string($_POST['name']);
        $descricao = $conn->real_escape_string($_POST['descricao']);
        $preco = $conn->real_escape_string($_POST['preco']);
        $category = $conn->real_escape_string($_POST['category']);
        $dados_produto = $conn->real_escape_string($_POST['dados_produto']);
        $estoque = $conn->real_escape_string($_POST['estoque']);

        // Criando instância do modelo
        $userModel = new UserModel($conn);

        // Inserindo o produto no banco de dados
        try {
            $url_img = $userModel->uploadImage($_FILES); // Captura a URL da imagem
            $produtoCriado = $userModel->createProduto($name, $descricao, $preco, $category, $dados_produto, $estoque,$url_img, $vendedor_id);


            if ($produtoCriado) {
                echo "Produto inserido com sucesso!";
            } else {
                echo "Erro ao inserir produto.";
            }
        } catch (Exception $e) {
            echo "Erro ao criar produto: " . $e->getMessage();
        }
    }
}


?>


