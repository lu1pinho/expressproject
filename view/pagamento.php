<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma de pagamento</title>
    <link rel="stylesheet" href="../view/stylesheets/pagamento.css">
</head>

<body>

    <header>
        <div class="banner">
            <div class="logo">
                <img src="../view/images/logo/logo.png" alt="Express.com">
            </div>
            <div class="butao-voltar">
                <a href="../control/control_finalizar_pedido.php">
                    <button class="btn-voltar" onclick="window.history.back();">Voltar</button>
                </a>
            </div>
        </div>
    </header>

    <main>
        <section class="container">
            <h2>Cartões Cadastrados</h2>
            <?php if (!empty($cartoes)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nome Cartão</th>
                            <th>Apelido</th>
                            <th>Número do Cartão</th>
                            <th>Data de Expedição</th>
                            <th>CVV</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartoes as $cartao): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($cartao['nome_cartao']); ?></td>
                                <td><?php echo htmlspecialchars($cartao['apelido']); ?></td>
                                <td><?php echo htmlspecialchars($cartao['numero_cartao']); ?></td>
                                <td><?php echo htmlspecialchars($cartao['dt_expedicao']); ?></td>
                                <td><?php echo htmlspecialchars($cartao['cvv']); ?></td>
                                <td><?php echo htmlspecialchars($cartao['categoria_cartao']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Não há cartões cadastrados para este usuário.</p>
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
            <a href="">
                <button class="btn-continuar">Comprar</button>
            </a>
        </section>
    </main>

</body>

</html>