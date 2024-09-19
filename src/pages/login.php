<?php
    include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="..\pages\login.css">
</head>

<body>
    <header class="cabecalho">
        <img src="fotos\image 2.png" width="85" height="70">
        <h1 class="h1">Express.com</h1>
    </header>

    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="login.php">
            <h1 class="titulo">Fazer login</h1>
            <h3 class="campos">Usuário:</h3>
            <input class="bordas" id="campo_nome" type="text" name="username"required>
            <h3 class="campos">Senha:</h3>
            <input class="bordas" id="campo_senha" type="password" name="password" required>          
            <div class="centro">
                 <input type="submit" name="submit" class="botoes" >       
            </div>
            

            <hr/>

            <div class="cadastro">
                <p class="aviso">Ainda não possui uma conta?</p>
              <a class="botoes" href="cadastro.html                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              ">Cadastrar</a>  
            </div>      
        </form>
    </div>
      
</body>
</html>