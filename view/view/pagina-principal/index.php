<?php
require_once '../../settings/SessionManager.php';

// Verifica se foi clicado no botão de logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "<script>console.log('Sessão encerrada.');</script>"; // Mensagem de sucesso
    header("Location: ../login/login.php");
    exit();
}

// Verifica se o usuário está logado - DESCOMENTE AS LINHAS ABAIXO
//if (!SessionManager::get('name')) {
//    header("Location: ../login/login.php");
//    exit();
//}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Realizado com sucesso!</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Login Realizado com sucesso!</h1>
    <p>Seja bem-vindo, <?php echo SessionManager::get('name'); ?>!</p>
    <form method="POST" name="logout">
        <button type="submit" name="logout">Sair</button>
    </form>
</div>
</body>
</html>
