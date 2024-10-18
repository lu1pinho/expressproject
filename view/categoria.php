<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://raw.githubusercontent.com/MaxyFR/doublerange/main/doubleRange.js"></script>

    <link rel="stylesheet" href="../view/nav.php">
    <link rel="stylesheet" href="../modular/footer/footer.css">
    <link rel="stylesheet" href="../view/stylesheets/categoria.css">

    <title>Categoria</title>
</head>

<body>
    <nav>
        <?php include('../view/nav.php'); ?>
    </nav>
    <div class="main-layout">
        <aside>
            <div class="aside-container">
                <h2>Departamento</h2>
                <form method="POST" id="filtrosForm">
                    <select name="departamento" id="departamento">
                        <option value="all">Todos os Produtos</option>
                        <?php
                        if ($result_departamentos->num_rows > 0) {
                            while ($row = $result_departamentos->fetch_assoc()) {
                                $categoria_formatada = formatarNomeCategoria($row['categoria']);
                                echo '<option value="' . $row['categoria'] . '">' . $categoria_formatada . '</option>';
                            }
                        } else {
                            echo '<option value="">Nenhum departamento encontrado</option>';
                        }
                        ?>
                    </select>

                    <div class="ajuste-preco">
                        <h2>Intervalo de Preço</h2>
                        <div class="range_container">
                            <div class="sliders_control">
                                <input id="fromSlider" type="range" name="preco_min" value="0" min="0" max="12000" />
                                <input id="toSlider" type="range" name="preco_max" value="12000" min="0" max="12000" />
                            </div>
                            <div class="form_control">
                                <div class="form_control_container">
                                    <div class="form_control_container__time">Min</div>
                                    <input class="form_control_container__time__input" type="number" name="preco_min" id="fromInput" value="0" min="0" max="12000" />
                                </div>
                                <div class="form_control_container">
                                    <div class="form_control_container__time">Max</div>
                                    <input class="form_control_container__time__input" type="number" name="preco_max" id="toInput" value="12000" min="0" max="12000" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ofertas">
                        <h2>Ofertas e Descontos</h2>
                        <div class="oferta-diaria ctr pd-5px">
                            <input type="checkbox" id="ofertas" name="ofertas" class="ui-checkbox">
                            <label for="ofertas">Oferta Diária</label>
                        </div>
                        <div class="desc ctr pd-5px">
                            <input type="checkbox" id="descontos" name="descontos" class="ui-checkbox">
                            <label for="descontos">Todos os Descontos</label>
                        </div>
                    </div>

                    <div class="opcoes">
                        <h2>Frete e GoExpress</h2>
                        <div class="free ctr pd-5px">
                            <input type="checkbox" id="frete" name="frete" class="ui-checkbox">
                            <label for="frete">Frete Grátis</label>
                        </div>
                        <div class="express-frete ctr pd-5px">
                            <input type="checkbox" id="express" name="express" class="ui-checkbox">
                            <label for="express">GoExpress</label>
                        </div>
                    </div>

                    <div class="aplicar">
                        <button id="aplicar" type="submit">Aplicar</button>
                    </div>
                </form>
            </div>
        </aside>

        <main>
            <h2>Produtos</h2>
            <div class="produtos-container">
                <?php
                if ($result_produtos->num_rows > 0) {
                    while ($produto = $result_produtos->fetch_assoc()) {
                        // Verifica se a chave 'url_img' existe e não está vazia
                        $imagem_produto = !empty($produto['url_img']) ? CAMINHO_IMAGENS . $produto['url_img'] : CAMINHO_IMAGENS . 'default.png';

                        echo '<div class="produto" onclick="window.location.href=\'../../../newsource/paginas/produto-individual/produto.php?id=' . $produto['id'] . '\'">';
                        echo '<img src="' . $imagem_produto . '" alt="' . $produto['nome'] . '">';
                        echo '<h3>' . $produto['nome'] . '</h3>';
                        echo '<p>R$' . number_format($produto['preco'], 2, ',', '.') . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Nenhum produto encontrado.</p>';
                }
                ?>
            </div>
        </main>
    </div>

    <script src="../view//scripts/categoria.js"></script>
</body>

</html>