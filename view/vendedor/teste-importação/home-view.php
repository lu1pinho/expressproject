<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../view/vendedor/modular/sidebar/sidebar.css">

    <!-- Importe o CSS -->
    <style>
        main {
            margin-left: 250px;
            padding: 20px;
            transition: 2ms;
        }

        @media (max-width: 700px) {

            main {
                margin-left: 60px;
                transition: 1s;
            }

            .express-logo img {
                display: none;
                transition: 1s;
            }

            .aside-container {
                width: 60px;
                transition: 2ms;
            }

            .aside-menu span {
                display: none;
                transition: 2ms;
            }

            .aside-menu ul p{
                display: none;
                transition: 2ms;
            }

            .sealer-info {
                border: none;
                transition: 2ms;
            }

            .profile-info {
                display: none;
                transition: 2ms;
            }



        }
    </style>

    <title>Vendedor Dashboard</title>
</head>
<body>
<?php include_once '../../../view/vendedor/modular/sidebar/sidebar.php'; ?>
<main>
    <div class="container">
        <h1>Teste de Contéudo</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium asperiores dolor numquam quibusdam, reiciendis rerum ullam? Aspernatur at cumque debitis exercitationem, fugiat harum, illum odit, saepe sapiente soluta temporibus veritatis!</p>
    </div>
</main>
</body>
</html>
