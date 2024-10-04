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
            <input type="text" placeholder="Buscar na Express">
            <div class="search-icon">
                <img src="../principal/images/svg/search.svg" alt="Ícone de busca">
            </div>
        </div>

        <div class="nav-item rem-9" id="login">
            <p class="wrap" onmouseenter="showLoginPopup()" onmouseleave="hideLoginPopup()">Faça seu login.</p>
        </div>

        <div class="nav-item rem-9">
            <p>Pedidos<br>e Devoluções</p>
        </div>

        <div class="nav-item rem-9">
            <img src="../principal/images/svg/shopping_cart.svg" alt="Carrinho">
            <p>Carrinho</p>
        </div>
    </nav>
</header>

<!-- NAV INFERIOR -->
<div class="botton-nav">
    <div class="menu">
        <div class="option todos-menu">
            <img src="../principal/images/svg/menu.svg" alt="Menu">
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

<!-- POPUP - LOGIN -->
<div id="login-popup" class="form" style="display: flex;" onmouseenter="keepLoginPopup()" onmouseleave="hideLoginPopupWithDelay()">
    <button class="button-submit" type="submit">Fazer Login</button>
    <p class="p">Não tem uma conta Express? <span class="span">Cadastre-se</span></p>
</div>

<!-- CATEGORIAS POPUP -->
<div class="popup-todos">
    <div class="categoria">
        <ul>
            <li><a href="#">Eletrônicos</a></li>
            <li><a href="#">Informática</a></li>
            <li><a href="#">Smartphones</a></li>
            <li><a href="#">TV e Vídeo</a></li>
            <li><a href="#">Áudio</a></li>
            <li><a href="#">Games</a></li>
            <li><a href="#">Tablets</a></li>
        </ul>
    </div>
</div>

<!-- Script -->
<script src="../../../newsource/paginas/modular/nav/nav.js"></script>
