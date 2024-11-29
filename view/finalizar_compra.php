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
                    <button class="button-voltar">
                        <span class="button-elem">
                            <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
                            </svg>
                        </span>
                        <span class="button-elem">
                            <svg viewBox="0 0 46 40">
                                <path
                                    d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
                            </svg>
                        </span>
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