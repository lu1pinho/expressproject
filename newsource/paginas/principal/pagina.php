<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../principal/stylesheets/index.css">
    <title>Express.com</title>
</head>
<body>
<header>
    <nav class="nav-container">
        <div class="express-logo">
            <img src="../principal/images/logo/logo.png" alt="Logo Express">
        </div>

        <div class="nav-item rem-9">
            <img src="../principal/images/svg/map-local.svg" alt="Atualizar CEP">
            <p>Atualizar CEP</p>
        </div>

        <div class="search-container">
            <input type="text" placeholder="Buscar na Express"=>
            <div class="search-icon">
                <img src="../principal/images/svg/search.svg" alt="">
            </div>
        </div>

        <div class="nav-item rem-9" id="login">
            <p class="wrap" onmouseenter="showPopup()" onmouseleave="startTimeout()">faça seu login.</p>
        </div>

        <div class="nav-item rem-9">
            <p class="">Pedidos<br>e Devoluções</p>
        </div>

        <div class="nav-item rem-9">
            <img src="../principal/images/svg/shopping_cart.svg" alt="Atualizar CEP">
            <p>Carrinho</p>
        </div
    </nav>
</header>

<!--    NAV INFERIOR-->
<div class="botton-nav">
    <div class="menu">
        <div class="option todos-menu">
            <img src="../principal/images/svg/menu.svg" alt="">
            <p>Todos</p>
        </div>
        <div class="option">
            <p>Venda na Express</p>
        </div>
        <div class="option">
            <p>Ofertas do Dia</p>
        </div>
        <div class="option">
            <p>Mais Vendidos</p>
        </div>
        <div class="option">
            <p>Comprar Novamente</p>
        </div>
    </div>
</div>

<!--    POPUP - LOGIN-->
<div id="login-popup" class="form" style="visibility: hidden;">
    <button class="button-submit" type="submit">Fazer Login</button>
    <p class="p">Não tem uma conta Express? <span class="span">Cadastre-se</span></p>
</div>

<div class="popup-todos">
    <div class="categoria">
        <ul>
            <li><a href="#">Eletrônicos</a></li>
            <li><a href="#">Informática</a></li>
            <li><a href="#">Smartphones</a></li>
            <li><a href="#">TV e Vídeo</a></li>
            <li><a href="#">Áudio</a></li>
            <li><a href="#">Games</a></li>
            <li><a href="#">Utilidades Domésticas</a></li>
            <li><a href="#">Brinquedos</a></li>
        </ul>
    </div>
</div>


<!-- CARROSEL-->
<main>

</main>
<div class="baba">
    <div class="carousel">
        <div class="slider">
            <section>
                <img src="../principal/images/banner/expressblack.png" alt="">
            </section>
            <section>
                <img src="../principal/images/banner/expressblack.png" alt="">
            </section>
            <section>content3</section>
            <section>content4</section>
            <section>content5</section>
            <section>content6</section>
            <section>content7</section>
            <section>content8</section>
            <section>content9</section>
            <section>content10</section>
        </div>
        <div class="slider-controls">
            <span class="arrow left material-icons"><</span>
            <span class="arrow right material-icons">></span>
            <ul style="visibility: hidden">
                <li class="selected"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="category">
            <div class="category-card">
                <img src="../principal/images/categorias/1.png" alt="">
            </div><div class="category-card">
                <img src="../principal/images/categorias/2.png" alt="">
            </div><div class="category-card">
                <img src="../principal/images/categorias/3.png" alt="">
            </div><div class="category-card">
                <img src="../principal/images/categorias/4.png" alt="">
            </div><div class="category-card">
                <img src="../principal/images/categorias/5.png" alt="">
            </div><div class="category-card">
                <img src="../principal/images/categorias/6.png" alt="">
            </div>
        </div>
    </div>
</div>

<main class="corpo">
    <div class="produto-container">
        <div class="title" id="ofertas-do-dia">
            <h2>Ofertas do Dia</h2>
            <p>Ver todos os produtos</p>
        </div>

        <div class="destaque">
            <div class="destaques">
                <img src="../index/outros/produtos/ipad.jpg" alt="">
                <p>IPad Air de 13 polegadas Wi-Fi<br>128GB - Cinza-Espacial</p>
                <p>R$ 00,00</p>
            </div>
            <div class="destaques">
                <img src="../index/outros/produtos/iphone14.webp" alt="">
                <p>iPhone 13 Apple 128GB<br></p>
                <p>R$ 00,00</p>
            </div>
            <div class="destaques">
                <img src="../index/outros/produtos/iphone16.webp" alt="">
                <p>iPhone 16 Apple 256GB</p>
                <p>R$ 00,00</p>
            </div>
            <div class="destaques">
                <img src="../index/outros/produtos/iPhone.jpg" alt="">
                <p>iPhone 15 Pro Max Apple <br>256GB - Cinza</p>
                <p>R$ 00,00</p>
            </div><div class="destaques">
                <img src="../index/outros/produtos/alexa.jpeg" alt="">
                <p>Echo Dot 5ª geração<br>Cor Preta</p>
                <p>R$ 00,00</p>
            </div><div class="destaques">
                <img src="../index/outros/produtos/firestick.jpg" alt="">
                <p>FireStick 4k</p>
                <p>R$ 00,00</p>
            </div>
        </div>
    </div>
</main>

<script src="../principal/scripts/index.js"></script>
</body>
</html>