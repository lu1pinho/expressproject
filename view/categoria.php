<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../modular/nav/nav.css">
    <link rel="stylesheet" href="../modular/footer/footer.css">
    <link rel="stylesheet" href="../view/categoria.css">
    <title>Categoria</title>
</head>
<body>
<?php include __DIR__ . '/../partials/nav.php'; ?>

<main>
    <aside>
        <div class="aside-container">
            <h2>Departamento</h2>
            <form method="GET" id="filtros">
                <select name="departamento" id="departamento">
                    <option value="all">Todos os Produtos</option>
                    <?php
                    if ($categorias->num_rows > 0) {
                        while ($row = $categorias->fetch_assoc()) {
                            echo '<option value="' . $row['categoria'] . '">' . formatarNomeCategoria($row['categoria']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum departamento encontrado</option>';
                    }
                    ?>
                </select>

                <!-- Outros filtros aqui... -->

                <div class="aplicar">
                    <button type="submit" id="aplicar">Aplicar</button>
                </div>
            </form>
        </div>
    </aside>

    <section>
        <div class="container">
            <h3><?php echo $produtos->num_rows; ?> produtos encontrados para os filtros selecionados</h3>
            <div class="produtos">
                <?php
                if ($produtos->num_rows > 0) {
                    while ($produto = $produtos->fetch_assoc()) {
                        $resultado = $this->model->calcularDesconto($produto['preco'], $produto['preco_com_desconto']);
                        ?>
                        <div class="produto" onclick="window.location.href='produto.php?id=<?php echo $produto['id']; ?>'">
                            <div class="produto-imagem">
                                <img src="<?php echo CAMINHO_IMAGENS . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>">
                            </div>
                            <div class="produto-descricao">
                                <h3><?php echo $produto['nome']; ?></h3>
                                <div class="price">
                                    <?php if ($resultado['percentual_desconto'] > 0) { ?>
                                        <span>De: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                                    <?php } ?>
                                    <span>R$ <?php echo $resultado['preco']; ?></span>
                                </div>
                                <?php if ($produto['frete_gratis']) { ?>
                                    <p class="frete-gratis">FRETE GRÁTIS</p>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>Nenhum produto encontrado.</p>';
                }
                ?>
            </div>
        </div>
    </section>
</main>

<script src="../view/categoria.js"></script>
<?php include __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>
