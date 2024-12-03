<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/cadastro.css">
    <!-- Importando Recursos Externos-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://accounts.google.com/gsi/client" async></script>
    <title>Crie sua Conta</title>
</head>
<body>
<main>
    <article>
        <form action="/expressproject/control/control_cadastro.php" method="POST">
            <div class="left">
                <img src="../materials/logos/logopreta.png" alt="Logo">
                <div class="text">
                    <p>Cadastre-se</p>
                </div>
                <div class="dados">
                    <div class="group">
                        <input required="required" type="text" class="input" id="firstname" name="name" minlength="2">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label id="namelabel">Nome</label>
                    </div>
                    <div class="group">
                        <input required="required" type="tel" class="input" id="phone" name="phone">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label id="cellabel">Telefone</label>
                    </div>
                    <div class="group">
                        <select required="required" class="input" id="category" name="category">
                            <option value="">Selecione</option>
                            <option value="cliente">Cliente</option>
                            <option value="fornecedor">Fornecedor</option>
                        </select>
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label id="categorylabel"></label>
                    </div>
                    <div class="group">
                        <input required="required" type="email" class="input" id="email" name="email">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label id="emaillabel">Email</label>
                    </div>
                    <div class="group">
                        <input required="required" type="password" class="input" id="password" name="password">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label id="passwordlabel">Senha</label>
                    </div>
                    <div class="group">
                        <input required="required" type="password" class="input" id="confirm-password" name="confirm-password">
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label id="confirm-passwordlabel">Confirme a Senha</label>
                    </div>
                    <div class="actions">
                        <button type="submit" id="submit">Continuar</button>
                        <p>Já possui uma conta? <a href="/view/view/logins/login.php" class="login-a">Faça Login</a></p>
                    </div>
                </div>
            </div>
        </form>
    </article>
</main>
<script src="./js/cadastro.js"></script>
</body>
</html>
