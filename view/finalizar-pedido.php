<?php
// Aqui você usaria o controller para obter os dados
include_once '../control/control_pedido.php';
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

$pedidoController = new PedidoController($conn);
$data = $pedidoController->finalizarPedido();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido - Express.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../view/finalizar-pedido.css">
</head>
<body>
    <header>
        <!-- O conteúdo do cabeçalho vai aqui -->
    </header>

    <div class="container-wrapper">
        <section class="entrega-container">
            <h2>Forma de entrega</h2>
            <?php if ($data['erro']): ?>
                <p class="erro"><?php echo $data['erro']; ?></p>
            <?php else: ?>
                <div class="entrega-opcao">
                    <p class="endereco-texto"><?php echo $data['enderecoCompleto']; ?></p>
                </div>
                <a href="dados-usuario.php">
                    <button class="btn-editar">Editar ou escolher outro endereço</button>
                </a>
            <?php endif; ?>
        </section>

        <article class="carrinho-container">
            <h2>Seu Carrinho</h2>
            <?php
            $total_produtos = 0;
            if ($data['carrinho']->num_rows > 0):
                while ($row = $data['carrinho']->fetch_assoc()):
                    $nome_produto = htmlspecialchars($row['produto_nome']);
                    $url_img = htmlspecialchars($row['url_img']);
                    $preco = $row['preco'];
                    $preco_com_desconto = $row['preco_com_desconto'];
                    $quantidade = $row['quantidade'];
                    $preco_final = $preco_com_desconto ?: $preco;
                    $total_item = $preco_final * $quantidade;
                    $total_produtos += $total_item;
            ?>
                    <article class="produto-carrinho">
                        <div class="produto-imagem">
                            <img src="<?php echo $url_img; ?>" alt="<?php echo $nome_produto; ?>">
                        </div>
                        <div class="produto-info">
                            <h3><?php echo $nome_produto; ?></h3>
                            <p>Preço: R$ <?php echo number_format($preco_final, 2, ',', '.'); ?></p>
                            <div class="quantidade-produto">
                                <label>Quantidade:</label>
                                <input type="text" value="<?php echo htmlspecialchars($quantidade); ?>" size="2" readonly>
                            </div>
                            <p>Total: R$ <?php echo number_format($total_item, 2, ',', '.'); ?></p>
                        </div>
                    </article>
            <?php
                endwhile;
            else:
                echo '<p>Seu carrinho está vazio.</p>';
            endif;
            ?>
        </article>
    </div>

    <section class="resumo-compra-container">
        <h2>Resumo da compra</h2>
        <div class="preco-detalhe">
            <p>Subtotal dos produtos</p>
            <p>R$ <?php echo number_format($total_produtos, 2, ',', '.'); ?></p>
        </div>
        <div class="preco-detalhe">
            <p>Frete</p>
            <p>R$ <?php echo number_format($data['frete'], 2, ',', '.'); ?></p>
        </div>
        <div class="total">
            <p>Total</p>
            <p>R$ <?php echo number_format($total_produtos + $data['frete'], 2, ',', '.'); ?></p>
        </div>
        <button class="btn-continuar">Continuar a compra</button>
    </section>

</body>
</html>
