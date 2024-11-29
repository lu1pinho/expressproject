<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../view/stylesheets/finalizar_compra.css">
</head>

<body>

    <header>
        <div class="banner">
            <div class="logo">
                <img src="../view/images/logo/logo.png" alt="Express.com">
            </div>
            <div class="butao-voltar">
                <form action="" method="GET">
                    <input type="hidden" name="action" value="voltar">
                    <button class="voltar">
                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                            <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
                        </svg>
                        <span>Voltar</span>
                    </button>
                </form>
            </div>

        </div>
    </header>

    <main class="container-wrapper">
        <section class="entrega-container">
            <h2>Forma de entrega</h2>
            <?php if (!empty($erro)): ?>
                <p class="erro"><?php echo $erro; ?></p>
            <?php else: ?>
                <div class="entrega-opcao">
                    <p class="endereco-texto"><?php echo $enderecoCompleto; ?></p>
                </div>
                <a href="../control/control_dados_usuario.php">
                    <button class="btn-editar">Editar ou escolher outro endereço</button>
                </a>
            <?php endif; ?>
        </section>

        <section class="carrinho-container">
            <h2>Seu Carrinho</h2>
            <?php if (!empty($itens_carrinho)): ?>
                <?php foreach ($itens_carrinho as $produto):
                    $nome_produto = htmlspecialchars($produto['produto_nome']);
                    $url_img = htmlspecialchars($produto['url_img']);
                    $preco = $produto['preco_com_desconto'] ?: $produto['preco'];
                    $quantidade = $produto['quantidade'];
                    $total_item = $preco * $quantidade;
                ?>
                    <article class="produto-carrinho">
                        <figure class="produto-imagem">
                            <img src="<?php echo $url_img; ?>" alt="<?php echo $nome_produto; ?>">
                        </figure>
                        <div class="produto-info">
                            <h3><?php echo $nome_produto; ?></h3>
                            <p>Preço: R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                            <div class="quantidade-produto">
                                <label>Quantidade:</label>
                                <input type="text" value="<?php echo htmlspecialchars($quantidade); ?>" size="2" readonly>
                            </div>
                            <p>Total: R$ <?php echo number_format($total_item, 2, ',', '.'); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Seu carrinho está vazio.</p>
            <?php endif; ?>
        </section>

        <section class="resumo-compra-container">
            <h2>Resumo da compra</h2>
            <div class="preco-detalhe">
                <p>Subtotal dos produtos</p>
                <p>R$ <?php echo number_format($total_produtos, 2, ',', '.'); ?></p>
            </div>
            <div class="preco-detalhe">
                <p>Frete</p>
                <p>R$ <?php echo number_format($frete, 2, ',', '.'); ?></p>
            </div>
            <div class="total">
                <p>Total</p>
                <p>R$ <?php echo number_format($total_produtos + $frete, 2, ',', '.'); ?></p>
            </div>
            <a href="../control/control_pagamento.php">
                <button class="btn-continuar">Continuar a compra</button>
            </a>
        </section>
    </main>
</body>

</html>