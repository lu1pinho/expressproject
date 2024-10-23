<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Cadastro</title>
    <link rel="stylesheet" href="../view/cadastro.css">
    <style>
    @font-face {
    font-family: 'Inter';
    src: url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    font-display: swap;
}
    .atualize {
        font-family: 'Inter';
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    body {
        background-color: rgb(240, 240, 240);
    }
    </style>
</head>

<body>
    <header class="cabecalho">
        <img src="../view/images/logo/logo.png" alt="Logotipo Express Marketplace" width="150">
    </header>

    <div class="apresentacao">
        <!-- Formulário de Atualização -->
        <form class="caixa_fundo" method="POST" action="">
            <h1 class="atualize" >Atualize seu cadastro para continuar</h1>

            <label for="email" class="campos">Email:</label>
            <input type="email" id="email" name="email" class="bordas" value="<?php echo htmlspecialchars($email); ?>" required>
            
            <label for="category" class="campos">Categoria:</label>
            <select id="category" name="category" class="bordas" required>
                <option value="cliente" <?= ($categoria == 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                <option value="fornecedor" <?= ($categoria == 'fornecedor') ? 'selected' : ''; ?>>Fornecedor</option>
            </select>

            <!-- Adicionar campo de senha -->
            <label for="senha" class="campos">Senha:</label>
            <input type="password" id="senha" name="senha" class="bordas" required>

            <!-- Aviso de senha incorreta, exibido acima do botão -->
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 'invalid_password') {
                echo "<p style='color:red; font-family:'inter';>Senha incorreta. Tente novamente.</p>";
            }

            if (isset($_GET['success']) && $_GET['success'] == 1) {
                echo "<p style='color:green;'>Cadastro atualizado com sucesso!</p>";
            }
            ?>

            <div class="centro">
                <button style="cursor: pointer;" type="submit" name="atualizar" class="botoes">Atualizar Cadastro</button>
            </div>
        </form>
    </div>
</body>
</html>
