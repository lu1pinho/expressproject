<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link rel="stylesheet" href="dados-usuario.css">
</head>
<body>
    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="../control/control_dados_usuario.php">
            <!-- Exibir os dados do usuário aqui -->
            <p class="titulo">Sua conta</p>
            <div class="dados">
                <div class="sub">
                    <label for="name" class="campos">Nome:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userData['userData']['nome']); ?>" class="bordas" required>

                    <label for="email" class="campos">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userData['userData']['email']); ?>" class="bordas" required>
                    <!-- Continue renderizando os dados da mesma forma -->
                </div>
            </div>
            <!-- Continue o resto do formulário -->
        </form>
    </div>
</body>
</html>
