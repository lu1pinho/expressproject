<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../view/produto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title><?php echo htmlspecialchars($productData['nome']); ?></title>
</head>
<body>
<?php include 'nav.php' ?>

<main>
    <div class="product-container">
        <div class="product-image">
            <img id='product-img' src="../view/produtos/<?php echo htmlspecialchars($productData['url_img']); ?>" alt="<?php echo htmlspecialchars($productData['nome']); ?>">
        </div>

        <div class="product-info">
            <h1><?php echo htmlspecialchars($productData['nome']); ?></h1>
            <div class="values">
                <div class="price">
                    <?php if ($porcentagem > 0): ?>
                        <span>R$ <?php echo number_format($preco, 2, ',', '.'); ?></span>
                        <p>R$ <?php echo number_format($precodesconto, 2, ',', '.'); ?></p>
                        <span>em até 10x de <?php echo dividirPor10($precodesconto); ?> sem juros no Cartão Express.</span>
                    <?php else: ?>
                        <p>R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                        <span>em até 10x de <?php echo dividirPor10($preco); ?> sem juros no Cartão Express.</span>
                    <?php endif; ?>
                </div>
                <div class="discount">
                    <?php if ($porcentagem > 0): ?>
                        <p><?php echo $porcentagem; ?>% de desconto comprando agora no PIX!</p>
                    <?php else: ?>
                        <?php
                        $messages = [
                            "Compre em até 10x sem juros! 😍",
                            "Compre agora e tenha frete express grátis 🤩"
                        ];
                        echo "<p>" . $messages[array_rand($messages)] . "</p>";
                        ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="short-description">
                <ul>
                    <li><?php echo formatText($productData['dados_produto']); ?></li>
                </ul>
            </div>
            <div class="popup-cart">
                <p>Adicionado Ao Carrinho!</p>
            </div>
            <!-- Adicionando ao carrinho -->
            <form action="/expressproject/control/control_carrinho.php" method="POST">
                <input type="hidden" name="produto_nome" value="<?php echo htmlspecialchars($productData['nome']); ?>">
                <input type="hidden" name="produto_imagem" value="<?php echo CAMINHO_IMAGENS . htmlspecialchars($productData['url_img']); ?>">
                <input type="hidden" name="produto_preco" value="<?php echo htmlspecialchars($preco); ?>">
                <input type="hidden" name="produto_preco_desconto" value="<?php echo htmlspecialchars($precodesconto); ?>">
                <div class="buy">
                    <button>Comprar</button>
                    <div class="up">
                        <button id="addcart">Adicionar Ao Carrinho</button>
                    </div>
                    <select name="quantidade" id="quantidade" value="1" min="1" required>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </form>
            <div class="favorite">
                <img class="love-icon" src="../view/img/svg/heart-thin-icon.svg" alt="Favoritar" width="30px">
            </div>
        </div>
    </div>

    <div class="product-full-description">
        <h2 id="text-desc">Descrição do Produto</h2>
        <div class="description">
            <?php echo formatText($productData['descricao']); ?>
        </div>
    </div>
</main>

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
            <a href="#"><img class="svg" src="../view/images/svg/facebook.svg" alt="Facebook"></a>
            <a href="#"><img class="svg" src="../view/images/svg/instagram.svg" alt="Instagram"></a>
            <a href="#"><img class="svg" src="../view/images/svg/twitter.svg" alt="Twitter"></a>
        </div>
    </div>
</footer>

    <script src="../view/nav.js"></script>
</body>
</html>
