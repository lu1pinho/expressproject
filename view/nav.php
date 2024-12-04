<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    @font-face {
    font-family: 'Inter';
    src: url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    font-display: swap;
}

:root {
    /* Variáveis de Cor */
    --color-primary: #004382;
    --color-secondary: #18344F;
    --color-darkblue: #001C36;
    --color-blue-4: #275682;
    --color-blue-5: #006BCF;
    --color-nav: #0a3a6a;
    --color-orange: #FF7F00;
    --color-light-orange: #FFA500;
}

/*Medidas*/
.rem-4 { font-size: 0.4rem; } .rem-5 { font-size: 0.5rem; } .rem-6 { font-size: 0.6rem; } .rem-7 { font-size: 0.7rem; } .rem-8 { font-size: 0.8rem; } .rem-9 { font-size: 0.9rem;} .rem-10 { font-size: 1rem; } .rem-12 { font-size: 1.2rem; } .rem-14 { font-size: 1.4rem; } .rem-16 { font-size: 1.6rem; } .rem-18 { font-size: 1.8rem; } .rem-20 { font-size: 2rem; } .rem-24 { font-size: 2.4rem; } .rem-28 { font-size: 2.8rem; } .rem-32 { font-size: 3.2rem; }

/*
O uso do `&` (e comercial) referencia o seletor pai dentro do aninhamento,
facilitando a aplicação de estilos específicos de forma concisa e legível.
Exemplo: `&:hover` se refere ao estado de hover do seletor pai.
*/

.show {
    opacity: 1;
    visibility: visible;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    font-size: 16px;
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', sans-serif;
    background-image: linear-gradient(to top, #f5f5f5, #ffff);
    background-repeat: no-repeat;
    background-color: white;
}

header{
    background-color:#001C36;
}

/*Logo*/
.express-logo img{
    width: auto;
    height: 40px;
    border: 0.5px solid transparent;
    padding: 2px;

    &:hover {
        border: 0.5px solid #ffffff;
        cursor: pointer;
    }
}

/*NAV*/

.nav-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 70px; max-height: 70px;
    background-color: var(--color-darkblue);
    padding-left: 80px;
    gap: 30px;
    position: sticky;
    top: 0;
    z-index: 100;
    width: 100%;

    & .nav-item {
        display: inline-flex;
        display: flex;
        align-items: center;
        padding: 5px 10px;
        height: 100%;
            width: auto;
            border: 0.5px solid transparent;
        }

        & .nav-item p {
            width: 100%;
            color: white;
            font-weight: 500;
        }

        & .nav-item:hover {
            cursor: pointer;
            border: 0.5px solid white;
        }

        .wrap {
        margin: 0;
        
        &::before {
            content: 'Olá,\A ';
            white-space: pre-line;
            color: #959595;
        }
    }
    #cep {
    width: auto;
    min-width: 150px; /* Largura mínima para evitar que a caixa fique muito estreita */
    padding: 5px;
}

        & .nav-item img {
            margin-right: 10px;
            min-width: 20px;
        }
    }
.option {
    font-family: 'Inter', sans-serif;
}
.coluna {
    display: flex;
    flex-direction: column;
    gap: 2px;
    margin-right: 10px;
}

/*Form POPUP*/

.form {
    transition: opacity 0.3s ease, visibility 0.3s ease;
    opacity: 0;
    /*visibility: hidden;*/
    display: flex;
    flex-direction: column;
    position: absolute;
    top: 70px;
    right: 300px;
    gap: 10px;
    background-color: #ffffff;
    padding: 2px;
    width: 250px;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    z-index: 2;
    height: 130px;
}

.form.show {
    opacity: 1;
    visibility: visible;
}

.form button {
    align-self: center;
}

.flex-row {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 10px;
    justify-content: center;
}

.button-submit {
    margin: 20px 0 10px 0;
    background-color: var(--color-orange);
    border: none;
    color: white;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 10px;
    height: 30px;
    width: 200px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.button-submit:hover {
    background-color: var(--color-light-orange);
}

.p {
    text-align: center;
    color: black;
    font-size: 14px;
    margin: 5px 0;
}

.span {
    color: var(--color-blue-5);
    cursor: pointer;
    text-decoration: underline;
}

/*Fim do PopUp*/
.botton-nav {
    display: flex;
    width: 100%;
    background-color: var(--color-nav);
    height: 30px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    align-items: center;
    padding-left: 110px;
    position: relative;
    z-index: 2;
    font-family: Inter;

    & .menu {
        display: flex;
        flex-direction: row;
        gap: 20px;
        color: white;
        align-items: center;
    }

    & .option {
        display: flex;  
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border: 0.5px solid transparent;
    }

    & .option:hover {
        cursor: pointer;
        border: 0.5px solid white;
    }

    & p {
        font-size: 0.9rem;
    }
}

/*Search Bar - NAV*/

.search-container {
    display: flex;
    align-items: center;
    justify-content: flex-start; /* Alterado para flex-start */
    height: 40px;
    margin: 0; /* Garantir que não haja margens */
}

.search-container input {
    border: none;
    outline: none;
    width: 400px;
    height: 100%;
    font-size: 14px;
    padding: 0 10px; /* Ajuste de padding */
    border-radius: 10px 0 0 10px;
    transition: border 0.5ms linear;

    &:focus {
        border: 3px solid var(--color-orange);
    }
}

.search-icon {
    display: flex;
    background-color: var(--color-orange);
    height: 40px;
    width: 50px;
    justify-content: center;
    align-items: center;
    border-radius: 0 10px 10px 0;

    & img {
        width: 25px;
        height: 25px;
        background-size: cover;
        background-repeat: no-repeat;
    }

    &:hover {
        cursor: pointer;
        background-color: var(--color-light-orange);
    }
}
/*Fim na NAV*/
  </style>
</head>
<body>
<header>
    <nav class="nav-container">
        <div class="express-logo">
            <a href="../control/control_pagina-principal.php"><img src="../view/images/logo/logo.png" alt="Logo Express"></a>
        </div>

        <div class="nav-item rem-9" id="cep">
            <img src="../view/images/svg/map-local.svg" alt="Localização">
            <p>CEP: 
                <?php 
                if (isset($_SESSION['cep'])) {
                    echo htmlspecialchars($_SESSION['cep']); 
                } else {
                    echo "Não disponível";
                }
                ?>
            </p>
        </div>



    <form class="search-container" action="../control/control_categoria.php" method="get">
        <input type="text" name="query" placeholder="Buscar na Express" required>
        <button style="border: none;" type="submit" class="search-icon" aria-label="Buscar">
            <img src="../view/images/svg/search.svg" alt="Buscar">
        </button>
    </form>



        <?php if (isset($_SESSION['nome'])): ?>
            <!-- A div será criada apenas se o usuário estiver logado -->
            <div class="nav-item rem-9 coluna" id="login">
                <p style="color: #959595;">Olá, <?php echo htmlspecialchars($_SESSION['nome']); ?>!</p>
                <a style="color: white; text-decoration: none;" href="../control/control_dados_usuario.php">Seus Dados</a>
            </div>
        <?php else: ?>
            <!-- Apenas um link será exibido se o usuário não estiver logado -->
            <a class="nav-item rem-9" id="login" style="text-decoration: none;" href="../control/control_login.php">
                <p class="wrap" onmouseenter="showLoginPopup()" onmouseleave="hideLoginPopup()">faça seu login.</p>
            </a>
        <?php endif; ?>

        <div class="nav-item rem-9">
            <img src="../view/images/svg/shopping_cart.svg" alt="Atualizar CEP">
            <a style="text-decoration: none; color: white;" href="..\control\control_carrinho.php">Carrinho</a>
        </div>
    </nav>
</header>

<!--    NAV INFERIOR-->
<div class="botton-nav">
    <div class="menu">
        <div class="option todos-menu">
            <img src="../view/images/svg/menu.svg" alt="">
            <p>Todos</p>
        </div>
        <div class="option">
        <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] === 'fornecedor'): ?>
                <a style="text-decoration: none; color: white;" href="../control/control_pagina-vendedor.php">Área do Vendedor</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['categoria']) && $_SESSION['categoria'] === 'cliente'): ?>
                <a style="text-decoration: none; color: white;" href="../control/control_atualizar-vendedor.php">Venda na Express</a>
            <?php endif; ?>
        </div>
        <div class="option">
            <p onclick="window.location.href='http://localhost/expressproject/control/control_categoria.php?departamento=game&preco_min=0&preco_max=12000&preco_min=0&preco_max=12000'">Ofertas do Dia</p>
        </div>
        <div class="option">
            <p onclick="window.location.href='http://localhost/expressproject/control/control_pagina-principal.php#mv'">Mais Vendidos</p>
        </div>
        <div class="option">
        <a style="text-decoration: none; color:white;" href="../control/control_pedidos_real.php">Pedidos Realizados</a>
        </div>
    </div>
</div>
</body>
</html>