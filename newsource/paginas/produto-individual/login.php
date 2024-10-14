<?php
    include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

    if(isset($_POST['submit'])){
        if(strlen($_POST['email']) == 0){
            echo "Preencha seu email";
        }else if(strlen($_POST['password']) == 0){
            echo "Preencha sua senha";
        }else{
            $email = $conn->real_escape_string($_POST['email']);
            $password = $conn->real_escape_string($_POST['password']);

            $sql_code = "SELECT * FROM users WHERE email = '$email' AND senha = '$password'";
            $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1){
                $usuario = $sql_query->fetch_assoc();

                session_start();

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];
                //echo "<script>alert('SUCESSO');</script>";
                header("Location: paginaprincipal.php");
            }else {
               echo "<script>alert('Falha ao logar! Nome de usuário ou senha incorretos');</script>";
                //echo "Falha ao logar! Nome de usuário ou senha incorretos";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="../produto-individual/stylesheets/login.css">
</head>

<body>
    <header class="cabecalho">
        <img src="../../fotos/image 2.png" width="85" height="70">
        <h1 class="h1">Express.com</h1>
    </header>

    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="login.php">
            <h1 class="titulo">Fazer login</h1>
            <h3 class="campos">Email:</h3>
                <input class="bordas" id="campo_nome" type="text" name="email"required>
            <h3 class="campos">Senha:</h3>
                <input class="bordas" id="campo_senha" type="password" name="password" required>          
            <div class="centro">
                 <input type="submit" name="submit" class="botoes" >       
            </div>
            

            <hr/>

            <div class="cadastro">
                <p class="aviso">Ainda não possui uma conta?</p>
              <a class="botoes" href="cadastro.php"                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ">Cadastrar</a>  
            </div>      
        </form>
    </div>
      
</body>
</html>