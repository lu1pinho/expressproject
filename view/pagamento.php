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
            <a href="../control/control_finalizar_pedido.php" class="button-voltar">
                <div class="button-box">
                    <span class="button-elem">
                        <svg viewBox="0 0 46 40" xmlns="http://www.w3.org/2000/svg">
                            <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
                        </svg>
                    </span>
                    <span class="button-elem">
                        <svg viewBox="0 0 46 40">
                            <path d="M46 20.038c0-.7-.3-1.5-.8-2.1l-16-17c-1.1-1-3.2-1.4-4.4-.3-1.2 1.1-1.2 3.3 0 4.4l11.3 11.9H3c-1.7 0-3 1.3-3 3s1.3 3 3 3h33.1l-11.3 11.9c-1 1-1.2 3.3 0 4.4 1.2 1.1 3.3.8 4.4-.3l16-17c.5-.5.8-1.1.8-1.9z"></path>
                        </svg>
                    </span>
                </div>
            </a>
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
                <a href="../control/control_dados_usuario.php">
                    <button class="editar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" height="20" fill="none" class="svg-icon">
                            <g stroke-width="1.5" stroke-linecap="round" stroke="#5d41de">
                                <circle r="2.5" cy="10" cx="10"></circle>
                                <path fill-rule="evenodd" d="m8.39079 2.80235c.53842-1.51424 2.67991-1.51424 3.21831-.00001.3392.95358 1.4284 1.40477 2.3425.97027 1.4514-.68995 2.9657.82427 2.2758 2.27575-.4345.91407.0166 2.00334.9702 2.34248 1.5143.53842 1.5143 2.67996 0 3.21836-.9536.3391-1.4047 1.4284-.9702 2.3425.6899 1.4514-.8244 2.9656-2.2758 2.2757-.9141-.4345-2.0033.0167-2.3425.9703-.5384 1.5142-2.67989 1.5142-3.21831 0-.33914-.9536-1.4284-1.4048-2.34247-.9703-1.45148.6899-2.96571-.8243-2.27575-2.2757.43449-.9141-.01669-2.0034-.97028-2.3425-1.51422-.5384-1.51422-2.67994.00001-3.21836.95358-.33914 1.40476-1.42841.97027-2.34248-.68996-1.45148.82427-2.9657 2.27575-2.27575.91407.4345 2.00333-.01669 2.34247-.97026z" clip-rule="evenodd"></path>
                            </g>
                        </svg>
                        <span class="label-editar">Editar</span>
                    </button>
                </a>
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
                    <p style="color: black;">Total</p>
                    <p style="color: black;">R$ <?php echo number_format($total_produtos + $frete, 2, ',', '.'); ?></p>
                </div>
                <button type="submit" name="comprar" class="btn-continuar">Comprar</button>
            </section>
        </form>

    </main>
</body>

</html>