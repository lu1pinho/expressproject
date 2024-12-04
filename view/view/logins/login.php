<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/login.css">

    <!-- Importando Recursos Externos - Não Remover -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://accounts.google.com/gsi/client" async></script>

    <title>Faça Login no Express</title>
</head>

<body>
    <main>
        <article>
            <div class="left">

            </div>
            <div class="right">
                <img src="../materials/logos/logopreta.png" alt="">
                <form method="POST" action="control/control_login.php"></form>
                    <div class="title"></div>
                    <div class="credentials">
                        <div class="group">
                            <input required="required" type="email" class="input" id="email-input" name="email" maxlength="254">
                            <span class="highlight"></span>
                            <span class="bar" id="mailbar"></span>
                            <label id="maillabel">Email</label>
                        </div>

                        <div class="group">
                            <input required="required" type="password" class="input" id="pass-input" name="senha" minlength="6">
                            <span class="highlight"></span>
                            <span class="bar"></span>
                            <label id="passlabel">Senha</label>
                        </div>
                    </div>

                    <p class="forgot"><a class="forgot" href="">Esqueci minha senha</a></p>

                    <div class="actions">
                        <output class="output" id="error-message" style="color: red;"></output>

                        <button id="submit">Fazer Login</button>
    

                        <p>Não tem uma conta? <a href="/expressproject/view/view/cadastros/cadastro.php">Cadastre-se</a></p>
                    </div>
                </form>

            </div>
        </article>
    </main>


    <script src="js/login.js"></script>
</body>

</html>