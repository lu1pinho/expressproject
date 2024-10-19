<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../view/index.css">
    <title>Express.com</title>
    <title>Express.com</title>
</head>

<body>
    <?php include 'nav.php'; ?>
    <!--    POPUP - LOGIN-->
    <div id="login-popup" class="form" style="display: flex;" onmouseenter="keepLoginPopup()" onmouseleave="hideLoginPopupWithDelay()">
        <a href="..\control\control_login.php">
            <button class="button-submit" type="submit">Fazer Login</button>
        </a>
    <p class="p">Não tem uma conta Express? <span class="span"><a href="..\control\control_cadastro.php">Cadastre-se</a></span></p>
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
                <li><a href="#">Tablets</a></li>
            </ul>
        </div>
    </div>


    <!-- CARROSEL-->
    <div class="baba">
        <div class="carousel">
            <div class="slider">
                <section>
                    <img src="../view/images/banner/expressblack.png" alt="">
                </section>
                <section><img src="../view/images/banner/7.png" alt=""></section>
                <section><img src="../view/images/banner/8.png" alt=""></section>
                <section><img src="../view/images/banner/9.png" alt=""></section>
                <section>content6</section>
                <section>content7</section>
                <section>content8</section>
                <section>content9</section>
                <section>content10</section>
                <section>
                </section>
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
                    <img src="../view/images/categorias/1.png" alt="">
                </div>
                <div class="category-card">
                    <img src="../view/images/categorias/2.png" alt="">
                </div>
                <div class="category-card">
                    <img src="../view/images/categorias/3.png" alt="">
                </div>
                <div class="category-card">
                    <img src="../view/images/categorias/4.png" alt="">
                </div>
                <div class="category-card">
                    <img src="../view/images/categorias/5.png" alt="">
                </div>
                <div class="category-card">
                    <img src="../view/images/categorias/6.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <main>
        <div class="produto-container">
            <div class="title" id="ofertas-do-dia">
                <h2>Ofertas do Dia</h2>
                <p>Ver todos os produtos</p>
            </div>

            <div class="destaque">
                <?php while ($produto = $ofertas_do_dia->fetch_assoc()) {
                    $resultado = calcularDesconto($produto['preco'], $produto['preco_com_desconto'], $produto['percentual_desconto']);
                ?>
                    <div class="destaques" onclick="window.location.href='../control/control-produto-individual.php?id=<?php echo $produto['id']; ?>'">
                        <img src="<?php echo CAMINHO_IMAGENS . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>">
                        <p><?php echo $produto['nome']; ?></p>
                        <div class="discount">
                            <?php if ($resultado['percentual_desconto'] > 0) { ?>
                                <p><?php echo $resultado['percentual_desconto']; ?>% OFF
                                    <?php if ($produto['frete_gratis']) {
                                        echo '- FRETE GRÁTIS';
                                    } ?></p>
                            <?php } else { ?>
                                <p><?php echo $resultado['frete_texto']; ?></p>
                            <?php } ?>
                        </div>
                        <div class="price">
                            <span>R$</span> <span><?php echo $resultado['preco']; ?></span> <!-- Parte inteira -->
                            <?php if ($resultado['percentual_desconto'] > 0) { ?>
                                <span>De: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span> <!-- Preço normal -->
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="produto-container">
            <div class="title" id="mais-vendidos">
                <h2>Mais Vendidos</h2>
                <p>Ver todos os produtos</p>
            </div>
            <div class="destaque">
    <?php while ($produto = $top_vendidos->fetch_assoc()) {
        $resultado = calcularDesconto($produto['preco'], $produto['preco_com_desconto'], $produto['percentual_desconto']);
    ?>
          <div class="destaques" onclick="window.location.href='../control/control-produto-individual.php?id=<?php echo $produto['id']; ?>'">
            <img src="<?php echo CAMINHO_IMAGENS . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>">
            <p><?php echo $produto['nome']; ?></p>
            <div class="discount">
                <?php if ($resultado['percentual_desconto'] > 0) { ?>
                    <p><?php echo $resultado['percentual_desconto']; ?>% OFF
                        <?php if ($produto['frete_gratis']) {
                            echo '- FRETE GRÁTIS';
                        } ?></p>
                <?php } else { ?>
                    <p><?php echo $resultado['frete_texto']; ?></p>
                <?php } ?>
            </div>
            <div class="price">
                <span>R$</span> <span><?php echo $resultado['preco']; ?></span> <!-- Parte inteira -->
                <?php if ($resultado['percentual_desconto'] > 0) { ?>
                    <span>De: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span> <!-- Preço normal -->
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<footer>
    <div class="footer-container">
        <div class="footer-item">
            <img src="../view/images/logo/logopreta.png" alt="Logo Express">
        </div>
        <div class="footer-item">
            <h3>Atendimento ao Cliente</h3>
            <a href="#">Central de Atendimento</a>
            <a href="#">Como Comprar</a>
            <a href="#">Formas de Pagamento</a>
            <a href="#">Política de Privacidade</a>
            <a href="#">Política de Troca e Devolução</a>
        </div>
        <div class="footer-item">
            <h3>Express Marketplace</h3>
            <a href="#">Quem Somos</a>
            <a href="#">Trabalhe Conosco</a>
            <a href="#">Seja um Parceiro</a>
        </div>
        <div class="footer-item">
            <h3>Minha Conta</h3>
            <a href="#">Meus Pedidos</a>
            <a href="#">Meus Dados</a>
            <a href="#">Meus Endereços</a>
        </div>
        <div class="footer-item">
            <h3>Siga-nos</h3>
            <a href="#"><img src="../view/images/social-icons/facebook.svg" alt="Facebook" width="30px"></a>
            <a href="#"><img src="../view/images/social-icons/instagram.svg" alt="Instagram" width="30px"></a>
            <a href="#"><img src="../view/images/social-icons/twitter.svg" alt="Twitter" width="30px"></a>
        </div>
    </div>
</footer>
</body>
</html>