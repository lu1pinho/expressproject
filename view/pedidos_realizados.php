<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Realizados</title>
    <link rel="stylesheet" href="../view/pedidos_realizados.css">
</head>

<body>
    <?php include 'nav.php';?>
    <main class="container">
        <section>
            <h2>Produtos Comprados</h2>

            <?php if ($produtos->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Imagem</th>
                            <th>Preço</th>
                            <th>Data da Compra</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $produtos->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['produto_nome']); ?></td>
                                <td>
                                    <img src="<?php echo CAMINHO_IMAGENS . htmlspecialchars($row['url_img']); ?>" alt="<?php echo htmlspecialchars($row['produto_nome']); ?>" width="100">
                                </td>
                                <td><?php echo 'R$ ' . number_format($row['preco'], 2, ',', '.'); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['data_compra'])); ?></td>
                                <td><?php echo htmlspecialchars($row['quantidade']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Nenhum produto encontrado.</p>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>
