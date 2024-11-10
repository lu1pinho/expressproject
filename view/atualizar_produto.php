<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../view/stylesheets/atualizar_produto.css">
    <link rel="stylesheet" href="../view/vendedor/modular/sidebar/sidebar.css">
    <title>Atualizar produtos do vendedor</title>
</head>

<body>
    <?php include_once 'C:/xampp/htdocs/expressproject/view/vendedor/modular/sidebar/sidebar.php'; ?>
    <section>
        <?php foreach ($produtos as $produto): ?>
            <div class="product-container">
                <!-- Formulário para salvar as alterações do produto -->
                <form action="../control/control_atualizar-produto.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

                    <!-- Imagem do produto -->
                    <div class="product-image">
                        <?php if (!empty($produto['url_img'])): ?>
                            <img src="<?php echo CAMINHO_IMAGENS . '/' . htmlspecialchars($produto['url_img']); ?>" alt="Imagem do Produto">
                        <?php else: ?>
                            <span>Sem imagem</span>
                        <?php endif; ?>
                    </div>

                    <!-- Detalhes do produto -->
                    <div class="product-details">
                        <div class="product-name">
                            <label for="nome-<?php echo $produto['id']; ?>">Nome:</label>
                            <input type="text" id="nome-<?php echo $produto['id']; ?>" name="nome" value="<?php echo htmlspecialchars($produto['nome']); ?>">
                        </div>

                        <div class="product-description">
                            <label for="descricao-<?php echo $produto['id']; ?>">Descrição:</label>
                            <textarea id="descricao-<?php echo $produto['id']; ?>" name="descricao" rows="4" cols="50"><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
                        </div>

                        <div class="product-data">
                            <label for="dados_produto-<?php echo $produto['id']; ?>">Dados do Produto:</label>
                            <textarea id="dados_produto-<?php echo $produto['id']; ?>" name="dados_produto" rows="4" cols="50"><?php echo htmlspecialchars($produto['dados_produto']); ?></textarea>
                        </div>

                        <div class="product-price">
                            <label for="preco-<?php echo $produto['id']; ?>">Preço:</label>
                            <input type="number" id="preco-<?php echo $produto['id']; ?>" name="preco" value="<?php echo htmlspecialchars($produto['preco']); ?>" step="0.01">
                        </div>

                        <div class="product-discount-price">
                            <label for="preco_com_desconto-<?php echo $produto['id']; ?>">Preço com Desconto:</label>
                            <input type="number" id="preco_com_desconto-<?php echo $produto['id']; ?>" name="preco_com_desconto" value="<?php echo htmlspecialchars($produto['preco_com_desconto']); ?>" step="0.01">
                        </div>

                        <div class="product-shipping">
                            <label for="frete_gratis-<?php echo $produto['id']; ?>">Frete Grátis:</label>
                            <input type="checkbox" id="frete_gratis-<?php echo $produto['id']; ?>" name="frete_gratis" <?php echo $produto['frete_gratis'] ? 'checked' : ''; ?>>
                        </div>

                        <div class="product-offer">
                            <label for="oferta_do_dia-<?php echo $produto['id']; ?>">Oferta do Dia:</label>
                            <input type="checkbox" id="oferta_do_dia-<?php echo $produto['id']; ?>" name="oferta_do_dia" <?php echo $produto['oferta_do_dia'] ? 'checked' : ''; ?>>
                        </div>

                        <!-- Seleção da Categoria -->
                        <div class="product-category">
                            <label for="categoria-<?php echo $produto['id']; ?>">Categoria:</label>
                            <input type="text" id="categoria-<?php echo $produto['id']; ?>" name="categoria" value="<?php echo htmlspecialchars($produto['categoria']); ?>">
                        </div>

                        <!-- Estoque e Frete -->
                        <div class="product-stock">
                            <label for="estoque-<?php echo $produto['id']; ?>">Estoque:</label>
                            <input type="number" id="estoque-<?php echo $produto['id']; ?>" name="estoque" value="<?php echo htmlspecialchars($produto['estoque']); ?>">
                        </div>

                        <div class="product-frete">
                            <label for="frete-<?php echo $produto['id']; ?>">Frete:</label>
                            <input type="text" id="frete-<?php echo $produto['id']; ?>" name="frete" value="<?php echo htmlspecialchars($produto['frete']); ?>">
                        </div>
                    </div>

                    <!-- Ações do Produto -->
                    <div class="product-actions">
                        <button type="submit">Salvar Alterações</button>
                    </div>
                </form>

                <!-- Formulário para excluir o produto -->
             <div class="product-close">
                <form action="../control/control_atualizar-produto.php" method="POST" style="display:inline;">
                    <input type="hidden" name="delete_id" value="<?php echo $produto['id']; ?>">
                    <button type="submit">Excluir Produto</button>
                </form>
            </div>

            </div>
        <?php endforeach; ?>
    </section>
</body>

</html>