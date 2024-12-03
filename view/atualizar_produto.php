<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/stylesheets/atualizar_produto.css">
    <link rel="stylesheet" href="../view/vendedor/modular/sidebar/sidebar.css">
    <title>Atualizar Produto</title>
</head>

<body>
    <?php include_once 'C:/xampp/htdocs/expressproject/view/vendedor/modular/sidebar/sidebar.php'; ?>

    <section>
        <?php if (isset($produto)): ?>
            <form action="../control/control_atualizar-produto.php" method="POST">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto['id']); ?>">

                <div class="product-image">
                    <?php if (!empty($produto['url_img'])): ?>
                        <img src="<?php echo CAMINHO_IMAGENS . '/' . htmlspecialchars($produto['url_img']); ?>" alt="Imagem do Produto">
                    <?php else: ?>
                        <span>Sem imagem</span>
                    <?php endif; ?>
                </div>

                <div class="product-details">
                    <div class="product-name">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>">
                    </div>

                    <div class="product-description">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="4"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
                    </div>

                    <div class="product-data">
                        <label for="dados_produto">Dados do Produto:</label>
                        <textarea id="dados_produto" name="dados_produto" rows="4"><?php echo htmlspecialchars($produto['dados_produto']); ?></textarea>
                    </div>

                    <div class="product-price">
                        <label for="preco">Preço:</label>
                        <input type="number" id="preco" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" step="0.01">
                    </div>

                    <div class="product-discount-price">
                        <label for="preco_com_desconto">Preço com Desconto:</label>
                        <input type="number" id="preco_com_desconto" name="preco_com_desconto" value="<?php echo htmlspecialchars($produto['preco_com_desconto']); ?>" step="0.01">
                    </div>

                    <div class="product-shipping">
                        <label for="frete_gratis">Frete Grátis:</label>
                        <input type="checkbox" id="frete_gratis" name="frete_gratis" <?php echo $produto['frete_gratis'] ? 'checked' : ''; ?>>
                    </div>

                    <div class="product-offer">
                        <label for="oferta_do_dia">Oferta do Dia:</label>
                        <input type="checkbox" id="oferta_do_dia" name="oferta_do_dia" <?php echo $produto['oferta_do_dia'] ? 'checked' : ''; ?>>
                    </div>

                    <div class="product-category">
                        <!-- Campo de categoria removido -->
                    </div>

                    <div class="product-stock">
                        <label for="estoque">Estoque:</label>
                        <input type="number" id="estoque" name="estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>">
                    </div>

                    <div class="product-frete">
                        <label for="frete">Frete:</label>
                        <input type="text" id="frete" name="frete" value="<?php echo htmlspecialchars($produto['frete']); ?>">
                    </div>
                </div>

                <div class="product-actions">
                    <button type="submit">Salvar Alterações</button>
                </div>
            </form>

            <div class="product-close">
                <form action="../control/control_excluir-produto.php" method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo htmlspecialchars($produto['id']); ?>">
                    <button type="submit">Excluir Produto</button>
                </form>
            </div>
        <?php else: ?>
            <p>Produto não encontrado.</p>
        <?php endif; ?>
    </section>
</body>

</html>