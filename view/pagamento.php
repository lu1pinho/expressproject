<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link rel="stylesheet" href="../view/stylesheets/pagamento.css">
</head>

<body>

    <header>
        <div class="banner">
            <div class="logo">
                <img src="../view/images/logo/logo.png" alt="Express.com">
            </div>
            <div class="butao-voltar">
                <a href="../control/control_finalizar_pedido.php" class="voltar">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                        <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
                    </svg>
                    <span>Voltar</span>
                </a>
            </div>
        </div>
    </header>



    <main>
        <section class="container">
            <h2>Cartões Cadastrados</h2>
            <?php if (!empty($cartoes)): ?>
                <table>
                    <thead class="dados">
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
                            <tr>
                                <td colspan="6">
                                    <div class="flip-card">
                                        <div class="flip-card-inner">
                                            <div class="flip-card-front">
                                                <div class="name"><?php echo htmlspecialchars($cartao['nome_cartao']); ?></div>
                                                <p class="heading_8264"><?php echo htmlspecialchars($cartao['categoria_cartao']); ?></p>
                                                <div class="date_8264"><?php echo htmlspecialchars($cartao['dt_expedicao']); ?></div>
                                                <div class="code"><?php echo htmlspecialchars($cartao['cvv']); ?></div>
                                            </div>
                                            <div class="flip-card-back">
                                                <div class="number"><?php echo htmlspecialchars($cartao['numero_cartao']); ?></div>
                                                <div class="strip"></div>
                                                <div class="mstrip"></div>
                                                <div class="sstrip"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>


                </table>
            <?php else: ?>
                <p>Não há cartões cadastrados para este usuário.</p>
            <?php endif; ?>
        </section>

        <!-- Seção do resumo da compra -->
        <form action="" method="POST">
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
                    <p style="color: black;" >Total </p>
                    <p style="color: black;" >R$ <?php echo number_format($total_produtos + $frete, 2, ',', '.'); ?></p>
                </div>
                <button type="submit" name="comprar" class="btn-continuar">Comprar</button>
            </section>
        </form>

    </main>

</body>

</html>