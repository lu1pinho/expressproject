<?php
global $conn;
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
session_start();
// Define o caminho para as imagens
define('CAMINHO_IMAGENS', '../../produtos/');

// Busca as categorias existentes no banco de dados
$sql_departamentos = "SELECT categoria FROM produtos GROUP BY categoria";
$result_departamentos = $conn->query($sql_departamentos);

// Função para formatar o nome da categoria
function formatarNomeCategoria($categoria) {
    $categoria = str_replace('_', ' ', $categoria);
    $conectivos = ['de', 'do', 'da', 'dos', 'das', 'e'];
    $palavras = explode(' ', $categoria);

    foreach ($palavras as $key => $palavra) {
        if ($key == 0 || !in_array(strtolower($palavra), $conectivos)) {
            $palavras[$key] = ucfirst(strtolower($palavra));
        } else {
            $palavras[$key] = strtolower($palavra);
        }
    }
    return implode(' ', $palavras);
}

// Função para calcular o preço com desconto e o percentual
function calcularDesconto($preco, $preco_com_desconto) {
    if ($preco_com_desconto > 0) {
        $percentual_desconto = round((($preco - $preco_com_desconto) / $preco) * 100);
        $preco_final = number_format($preco_com_desconto, 2, ',', '.');
    } else {
        $percentual_desconto = 0;
        $preco_final = number_format($preco, 2, ',', '.');
    }
    return [
        'percentual_desconto' => $percentual_desconto,
        'preco' => $preco_final
    ];
}

// Recebe os filtros da página
$departamento = isset($_GET['departamento']) ? $_GET['departamento'] : 'all';
$preco_min = isset($_GET['preco_min']) ? $_GET['preco_min'] : 0;
$preco_max = isset($_GET['preco_max']) ? $_GET['preco_max'] : 12000;
$ofertas = isset($_GET['ofertas']) ? 1 : 0;
$descontos = isset($_GET['descontos']) ? 1 : 0;
$frete_gratis = isset($_GET['frete']) ? 1 : 0;
$goexpress = isset($_GET['express']) ? 1 : 0;

// Monta a query de busca com base nos filtros
$sql_produtos = "SELECT * FROM produtos WHERE preco BETWEEN $preco_min AND $preco_max";

// Filtro de departamento
if ($departamento != 'all') {
    $sql_produtos .= " AND categoria = '$departamento'";
}

// Filtro de ofertas
if ($ofertas) {
    $sql_produtos .= " AND oferta_do_dia = 1";
}

// Filtro de descontos
if ($descontos) {
    $sql_produtos .= " AND preco_com_desconto > 0";
}

// Filtro de frete grátis
if ($frete_gratis) {
    $sql_produtos .= " AND frete_gratis = 1";
}

// Filtro GoExpress
if ($goexpress) {
    $sql_produtos .= " AND go_express = 1";
}

// Executa a query
$result_produtos = $conn->query($sql_produtos);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://raw.githubusercontent.com/MaxyFR/doublerange/main/doubleRange.js"></script>

    <link rel="stylesheet" href="../modular/nav/nav.css">
    <link rel="stylesheet" href="../modular/footer/footer.css">
    <link rel="stylesheet" href="../categorias/stylesheets/categoria.css">

    <title>Categoria</title>
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/expressproject/newsource/paginas/principal/nav.php'; ?>

<main>
    <aside>
        <div class="aside-container">
            <h2>Departamento</h2>
            <form method="GET" id="filtros">
                <select name="departamento" id="departamento">
                    <?php
                    echo '<option value="all">Todos os Produtos</option>';
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
                                <input class="form_control_container__time__input" type="number" id="fromInput" value="0" min="0" max="12000" />
                            </div>
                            <div class="form_control_container">
                                <div class="form_control_container__time">Max</div>
                                <input class="form_control_container__time__input" type="number" id="toInput" value="12000" min="0" max="12000" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ofertas">
                    <h2>Ofertas e Descontos</h2>
                    <div class="oferta-diaria ctr pd-5px">
                        <input type="checkbox" name="ofertas" id="ofertas" class="ui-checkbox">
                        <label for="ofertas">Oferta Diária</label>
                    </div>
                    <div class="desc ctr pd-5px">
                        <input type="checkbox" name="descontos" id="descontos" class="ui-checkbox">
                        <label for="descontos">Todos os Descontos</label>
                    </div>
                </div>

                <div class="opcoes">
                    <h2>Frete e GoExpress</h2>
                    <div class="free ctr pd-5px">
                        <input type="checkbox" name="frete" id="frete" class="ui-checkbox">
                        <label for="frete">Frete Grátis</label>
                    </div>
                    <div class="express-frete ctr pd-5px">
                        <input type="checkbox" name="express" id="express" class="ui-checkbox">
                        <label for="express">GoExpress</label>
                    </div>
                </div>

                <div class="aplicar">
                    <button type="submit" id="aplicar">Aplicar</button>
                </div>
            </form>
        </div>
    </aside>

    <section>
        <div class="container">
            <h3><?php echo $result_produtos->num_rows; ?> produtos encontrados para os filtros selecionados</h3>
            <div class="produtos">
                <?php
                if ($result_produtos->num_rows > 0) {
                    while ($produto = $result_produtos->fetch_assoc()) {
                        $resultado = calcularDesconto($produto['preco'], $produto['preco_com_desconto']);
                        ?>
                        <div class="produto" onclick="window.location.href='../../../newsource/paginas/produto-individual/produto.php?id=<?php echo $produto['id']; ?>'">
                            <div class="produto-imagem">
                                <img src="<?php echo CAMINHO_IMAGENS . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>">
                            </div>
                            <div class="produto-descricao">
                                <h3><?php echo $produto['nome']; ?></h3>
                                <div class="price">
                                    <?php if ($resultado['percentual_desconto'] > 0) { ?>
                                        <span>De: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span> <!-- Preço original -->
                                    <?php } ?>
                                    <span>R$ <?php echo $resultado['preco']; ?></span> <!-- Parte do preço -->
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

<script src="../categorias/scripts/categorias.js"></script>
<?php include('../modular/footer/footer.php'); ?>
</body>
</html>
