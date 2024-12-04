<?php
include '../settings/connection.php'; // Conexão com o banco
include '../settings/config.php'; // Configurações gerais
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://raw.githubusercontent.com/MaxyFR/doublerange/main/doubleRange.js"></script>

    <link rel="stylesheet" href="../view/nav.php">
    <link rel="stylesheet" href="../modular/footer/footer.css">
    <link rel="stylesheet" href="../view/stylesheets/categoria.css">

    <title>Categoria</title>
</head>

<body>
<?php include 'nav.php'; ?>
<div class="popup-todos">
    <div class="categoria">
        <ul>
            <!-- Adicionando o redirecionamento para cada categoria -->
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=eletronico&preco_min=0&preco_max=12000">Eletrônicos</a></li>
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=informatica&preco_min=0&preco_max=12000">Informática</a></li>
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=smartphone&preco_min=0&preco_max=12000">Smartphones</a></li>
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=tv_e_video&preco_min=0&preco_max=12000">TV e Vídeo</a></li>
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=audio&preco_min=0&preco_max=12000">Áudio</a></li>
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=game&preco_min=0&preco_max=12000">Games</a></li>
            <li><a href="http://localhost/expressproject/control/control_categoria.php?departamento=tablets&preco_min=0&preco_max=12000">Tablets</a></li>
        </ul>
    </div>
</div>
<div class="main-layout">
    <aside>
        <div class="aside-container">
            <h2>Departamento</h2>
            <form method="GET" id="filtrosForm">
                <select name="departamento" id="departamento">
                    <option value="all" <?php echo (isset($_GET['departamento']) && $_GET['departamento'] == 'all') ? 'selected' : ''; ?>>Todos os Produtos</option>
                    <?php
                    // Obtendo categorias diretamente do banco
                    $sql = "SELECT DISTINCT categoria FROM produtos";
                    $result_departamentos = $conn->query($sql);

                    if ($result_departamentos->num_rows > 0) {
                        while ($row = $result_departamentos->fetch_assoc()) {
                            $categoria_formatada = ucfirst(strtolower($row['categoria']));
                            echo '<option value="' . $row['categoria'] . '" ' . (isset($_GET['departamento']) && $_GET['departamento'] == $row['categoria'] ? 'selected' : '') . '>' . $categoria_formatada . '</option>';
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
                            <input id="fromSlider" type="range" name="preco_min" value="<?php echo isset($_GET['preco_min']) ? $_GET['preco_min'] : '0'; ?>" min="0" max="12000" />
                            <input id="toSlider" type="range" name="preco_max" value="<?php echo isset($_GET['preco_max']) ? $_GET['preco_max'] : '12000'; ?>" min="0" max="12000" />
                        </div>
                        <div class="form_control">
                            <div class="form_control_container">
                                <div class="form_control_container__time">Min</div>
                                <input class="form_control_container__time__input" type="number" name="preco_min" id="fromInput" value="<?php echo isset($_GET['preco_min']) ? $_GET['preco_min'] : '0'; ?>" min="0" max="12000" />
                            </div>
                            <div class="form_control_container">
                                <div class="form_control_container__time">Max</div>
                                <input class="form_control_container__time__input" type="number" name="preco_max" id="toInput" value="<?php echo isset($_GET['preco_max']) ? $_GET['preco_max'] : '12000'; ?>" min="0" max="12000" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ofertas">
                    <h2>Ofertas e Descontos</h2>
                    <div class="oferta-diaria ctr pd-5px">
                        <input type="checkbox" id="ofertas" name="ofertas" class="ui-checkbox" <?php echo isset($_GET['ofertas']) ? 'checked' : ''; ?>>
                        <label for="ofertas">Oferta Diária</label>
                    </div>
                    <div class="desc ctr pd-5px">
                        <input type="checkbox" id="descontos" name="descontos" class="ui-checkbox" <?php echo isset($_GET['descontos']) ? 'checked' : ''; ?>>
                        <label for="descontos">Todos os Descontos</label>
                    </div>
                </div>

                <div class="opcoes">
                    <h2>Frete e GoExpress</h2>
                    <div class="free ctr pd-5px">
                        <input type="checkbox" id="frete" name="frete" class="ui-checkbox" <?php echo isset($_GET['frete']) ? 'checked' : ''; ?>>
                        <label for="frete">Frete Grátis</label>
                    </div>
                </div>

                <div class="aplicar">
                    <button id="aplicar" type="submit">Aplicar</button>
                </div>
            </form>
        </div>
    </aside>

    <?php
    // Definindo a função calcularDesconto no topo do arquivo
    function calcularDesconto($preco, $preco_com_desconto, $percentual_desconto) {
        if (!empty($percentual_desconto) && $percentual_desconto > 0) {
            $preco_com_desconto_calculado = $preco - ($preco * ($percentual_desconto / 100));
            return [
                'preco_com_desconto' => number_format($preco_com_desconto_calculado, 2, ',', '.'),
                'preco_original' => number_format($preco, 2, ',', '.'),
                'percentual_desconto' => $percentual_desconto
            ];
        }

        if (!empty($preco_com_desconto)) {
            return [
                'preco_com_desconto' => number_format($preco_com_desconto, 2, ',', '.'),
                'preco_original' => number_format($preco, 2, ',', '.'),
                'percentual_desconto' => round((($preco - $preco_com_desconto) / $preco) * 100)
            ];
        }

        return [
            'preco_com_desconto' => null,
            'preco_original' => number_format($preco, 2, ',', '.'),
            'percentual_desconto' => 0
        ];
    }
    ?>

    <main>
        <h2>Produtos Encontrados</h2>
        <div class="destaque">
            <?php
            // Iniciando a query para os produtos
            $sql = "SELECT * FROM produtos WHERE 1=1";

            // Filtro de pesquisa por nome
            if (!empty($_GET['query'])) {
                $query = $conn->real_escape_string($_GET['query']);
                $sql .= " AND (nome LIKE '%$query%' OR SOUNDEX(nome) = SOUNDEX('$query'))";
            }

            // Filtro de categoria
            if (isset($_GET['departamento']) && $_GET['departamento'] != 'all') {
                $sql .= " AND categoria = '" . $conn->real_escape_string($_GET['departamento']) . "'";
            }

            // Filtro de preço
            $preco_min = (float)($_GET['preco_min'] ?? 0);
            $preco_max = (float)($_GET['preco_max'] ?? 12000);
            $sql .= " AND preco BETWEEN $preco_min AND $preco_max";

            // Filtros adicionais
            if (isset($_GET['ofertas'])) {
                $sql .= " AND oferta_do_dia = 1";
            }
            if (isset($_GET['descontos'])) {
                $sql .= " AND percentual_desconto > 0";
            }
            if (isset($_GET['frete'])) {
                $sql .= " AND frete_gratis = 1";
            }
            if (isset($_GET['express'])) {
                $sql .= " AND express = 1";
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($produto = $result->fetch_assoc()) {
                    $imagem_produto = !empty($produto['url_img']) ? CAMINHO_IMAGENS . $produto['url_img'] : CAMINHO_IMAGENS . 'default.png';

                    // Calculando o desconto
                    $resultado = calcularDesconto($produto['preco'], $produto['preco_com_desconto'], $produto['percentual_desconto']);
                    ?>

                    <div class="destaques" onclick="window.location.href='../control/control-produto-individual.php?id=<?php echo $produto['id']; ?>'">
                        <img src="<?php echo $imagem_produto; ?>" alt="<?php echo $produto['nome']; ?>">
                        <p id="pname"><?php echo $produto['nome']; ?></p>
                        <div class="discount">
                            <?php if ($resultado['percentual_desconto'] > 0) { ?>
                                <p>
                                    <?php echo number_format($resultado['percentual_desconto'], 0); ?>% OFF
                                    <?php if ($produto['frete_gratis']) { ?>
                                        - FRETE GRÁTIS
                                    <?php } ?>
                                </p>
                            <?php } else { ?>
                                <p>FRETE EXPRESSO</p>
                            <?php } ?>
                        </div>
                        <div class="price">
                            <?php if (!is_null($resultado['preco_com_desconto'])) { ?>
                                <span class="preco-original">R$ <?php echo $resultado['preco_original']; ?></span>
                                <span class="preco-com-desconto">R$ <?php echo $resultado['preco_com_desconto']; ?></span>
                            <?php } else { ?>
                                <p class="preco-sem-desconto">R$ <?php echo $resultado['preco_original']; ?></p>
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
    </main>
</div>

<script src="../view/scripts/categoria.js"></script>
<script>
    // Categorias
    const menu_burger = document.querySelector('.todos-menu');
    const popup_todos = document.querySelector('.popup-todos');
    let mouseInElement = false;
    let timer;

    // Função para mostrar o popup
    function showPopup() {
        clearTimeout(timer); // Cancela o timer se ele estiver ativo
        popup_todos.style.top = '100px'; // Mostra o popup
    }

    // Função para esconder o popup com atraso
    function hidePopupWithDelay() {
        timer = setTimeout(() => {
            if (!mouseInElement) {
                popup_todos.style.top = '50px'; // Esconde o popup após 2s
            }
        }, 2000); // 2 segundos de atraso
    }

    // Quando o mouse entra em qualquer um dos elementos
    menu_burger.onmouseenter = popup_todos.onmouseenter = function () {
        mouseInElement = true;
        showPopup(); // Mostra o popup
    };

    // Quando o mouse sai de qualquer um dos elementos
    menu_burger.onmouseleave = popup_todos.onmouseleave = function () {
        mouseInElement = false;
        hidePopupWithDelay(); // Inicia o timer para esconder o popup
    };


</script>

</body>

</html>
