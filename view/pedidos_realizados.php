<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Realizados</title>
    <link rel="stylesheet" href="../view/pedidos_realizados.css">
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container">
        <h1>Pedidos Realizados</h1>

        <?php if (empty($pedidos)): ?>
            <p>Você ainda não fez nenhum pedido.</p>
        <?php else: ?>
            <?php foreach ($pedidos as $pedido): ?>
                <div class="pedido-item">
                    <h2>Pedido #<?= htmlspecialchars($pedido['id']); ?> - <?= htmlspecialchars($pedido['data_pedido']); ?></h2>
                    <p>Total: R$ <?= number_format($pedido['valor_total'], 2, ',', '.'); ?></p>

                    <div class="produtos">
                        <?php if (!empty($pedido['produtos'])): ?>
                            <?php foreach ($pedido['produtos'] as $produto): ?>
                                <div class="produto">
                                    <img src="<?= htmlspecialchars($produto['url_img']); ?>" alt="<?= htmlspecialchars($produto['nome']); ?>">
                                    <div class="detalhes-produto">
                                        <p><?= htmlspecialchars($produto['nome']); ?></p>
                                        <p>Quantidade: <?= htmlspecialchars($produto['quantidade']); ?></p>
                                        <p>Preço: R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Nenhum produto relacionado a este pedido.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>