<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="stylesheet" href="../view/login.css">
</head>

<header class="cabecalho">
    <h1 class="h1">Express.com</h1>
</header>

<div class="apresentacao">
    <form class="caixa_fundo" method="POST" action="../control/control_login.php">
        <h1 class="titulo">Fazer login</h1>
        <?php if (isset($errorMessage)) { ?>
            <p class="erro"><?php echo $errorMessage; ?></p>
        <?php } ?>
        <h3 class="campos">Email:</h3>
        <input class="bordas" id="campo_nome" type="text" name="email" required>
        <h3 class="campos">Senha:</h3>
        <input class="bordas" id="campo_senha" type="password" name="password" required>          
        <div class="centro">
             <input type="submit" name="submit" class="botoes">       
        </div>
        <hr/>
        <div class="cadastro">
            <p class="aviso">Ainda não possui uma conta?</p>
            <a class="botoes" href="cadastro.php">Cadastrar</a>  
        </div>      
    </form>
</div>
      
</body>
</html>