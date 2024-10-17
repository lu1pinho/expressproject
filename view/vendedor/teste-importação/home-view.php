<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Importe o CSS -->
    <link rel="stylesheet" href="../../../view/vendedor/modular/sidebar/sidebar.css">

    <style>
        /* Estilizando o container principal */
        main {
            display: flex;
            min-height: 100vh; /* Garante que ocupe toda a altura da tela */
        }

        /* Estilizando a sidebar */
        aside {
            width: 300px; /* Tamanho fixo da sidebar */
            background-color: #f1f1f1; /* Apenas para visualização */
        }

        /* Estilizando o conteúdo principal */
        .container {
            flex-grow: 1; /* Ocupa o restante do espaço */
            padding: 40px; /* Espaçamento interno */
            background-color: #fff; /* Apenas para visualização */
        }

        h1 {
            font-size: 24px;
        }

        form {
            margin-top: 20px;
        }
    </style>
    <title>Vendedor Dashboard</title>
</head>
<body>
<main>
    <!-- Incluindo a sidebar -->
    <?php include_once '../../../view/vendedor/modular/sidebar/sidebar.php'; ?>

    <!-- Conteúdo principal -->
    <div class="container">
        <h1>Teste de Contéudo</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium asperiores dolor numquam quibusdam, reiciendis rerum ullam? Aspernatur at cumque debitis exercitationem, fugiat harum, illum odit, saepe sapiente soluta temporibus veritatis!</p>
    </div>
</main>
</body>
</html>
