<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link rel="stylesheet" href="stylesheets\cadastro.css">
</head>

<body>
    <header class="cabecalho">
        <img src="images/logo.png" alt="Logotipo Express Marketplace" width="150">
    </header>

    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="cadastro.php">
            <h1 class="titulo">Fazer cadastro</h1>
            <label for="name" class="campos">Nome:</label>
            <input type="text" id="name" name="name" class="bordas" required>

            <label for="phone" class="campos">Telefone:</label>
            <input type="tel" id="phone" name="phone" class="bordas" required>

            <label for="category" class="campos">Categoria:</label>
            <select id="category" name="category" class="bordas" required>
                <option value="">Selecione</option>
                <option value="cliente">Cliente</option>
                <option value="fornecedor">Fornecedor</option>
            </select>

            <label for="email" class="campos">Email:</label>
            <input type="email" id="email" name="email" class="bordas" required>

            <label for="password" class="campos">Senha:</label>
            <input type="password" id="password" name="password" class="bordas" required>

            <label for="confirm-password" class="campos">Confirme a Senha:</label>
            <input type="password" id="confirm-password" name="confirm-password" class="bordas" required>

            <div class="centro">
                <button type="submit" class="botoes">Cadastrar</button>
            </div>

            <div class="cadastro">
                <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
            </div>

        </form>
    </div>

    <hr class="hr">

    <?php
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
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
        
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $category = $conn->real_escape_string($_POST['category']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        $sql_check_email = "SELECT * FROM users WHERE email = '$email'";
        $check_query = $conn->query($sql_check_email);
        if (!$check_query) {
            die("Falha ao executar a consulta: " . $conn->error);
        }

        if ($check_query->num_rows > 0) {
            echo "<script>alert('Este email já está cadastrado.');</script>";
        } else {
    
            $sql_insert = "INSERT INTO users (nome, telefone, categoria, email, senha) VALUES ('$name', '$phone', '$category', '$email', '$password')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
               
            } else {
                echo "Erro ao cadastrar: " . $conn->error;
            }
        }
    }
}
?>

</body>
</html>
