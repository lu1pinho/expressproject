<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Express.com</title>
    <link rel="stylesheet" href="../view/carrinho.css/">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <?php include '..\view\nav\nav.php'; ?>
    <div class="juntando">
        <div class="container">
            <div class="cart">
                <div class="back-button">
                    <a href="javascript:void(0);" class="arrow-link" onclick="goBack()">
                        <span class="arrow">&#8592;</span>
                    </a>
                    <span>Carrinho</span>
                </div>

                <!-- Verificar se o carrinho está vazio -->
                <?php if (empty($_SESSION['carrinho'])): ?>
                <p style="margin-left: 20px;">Seu carrinho está vazio.</p>
                <?php else: ?>
                <form action="carrinho.php" method="POST" id="carrinhoForm">
                    <?php foreach ($_SESSION['carrinho'] as $index => $item): ?>
                    <div class="cart-item">
                        <input class="check" type="checkbox" name="produtos_selecionados[]" value="<?= $index; ?>"
                            <?=(isset($_POST['produtos_selecionados']) && in_array($index,
                            $_POST['produtos_selecionados'])) ? 'checked' : '' ; ?>
                        onchange="document.getElementById('carrinhoForm').submit();">

                        <img class="product-image" src="<?= CAMINHO_IMAGENS . htmlspecialchars($item['url_img']); ?>"
                            alt="<?= htmlspecialchars($item['nome']); ?>" />
                        <div class="product-details">
                            <a href="#">
                                <?= htmlspecialchars($item['nome']); ?>
                            </a>
                            <p>
                                <?php if ($item['preco_com_desconto'] !== null): ?>
                                <span class="preco-original" style="text-decoration: line-through;">R$
                                    <?= number_format($item['preco'], 2, ',', '.'); ?>
                                </span>
                                <span class="preco-com-desconto">R$
                                    <?= number_format($item['preco_com_desconto'], 2, ',', '.'); ?>
                                </span>
                                <?php else: ?>
                                R$
                                <?= number_format($item['preco'], 2, ',', '.'); ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="quantity-control">
                            <button type="submit" name="alterar_quantidade[<?= $index; ?>]" value="plus"
                                class="btn-quantity">+</button>
                            <label class="quantity-label">
                                <?= $item['quantidade']; ?>
                            </label>
                            <button type="submit" name="alterar_quantidade[<?= $index; ?>]" value="minus"
                                class="btn-quantity">-</button>
                        </div>
                        <!-- Botão de remoção com valor do índice -->
                        <button type="submit" name="remover_item" value="<?= $index; ?>"
                            class="btn-remover">Remover</button>
                    </div> 
                    <?php endforeach; ?>
                </form>
                <?php endif; ?>
            </div> 
        </div> 
</body>

</html>