<?php
global $conn;
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

// Define o caminho para as imagens
define('CAMINHO_IMAGENS', '../../produtos/');

// Busca as categorias existentes no banco de dados
$sql_departamentos = "SELECT categoria FROM produtos GROUP BY categoria";
$result_departamentos = $conn->query($sql_departamentos);

// Função para formatar o nome da categoria
function formatarNomeCategoria($categoria) {
    // Remover underlines e substituí-los por espaços
    $categoria = str_replace('_', ' ', $categoria);

    // Lista de conectivos que devem ser minúsculos
    $conectivos = ['de', 'do', 'da', 'dos', 'das', 'e'];

    // Explode a string em palavras
    $palavras = explode(' ', $categoria);

    // Formatar a primeira letra de cada palavra
    foreach ($palavras as $key => $palavra) {
        // Verifica se a palavra está na lista de conectivos
        if ($key == 0 || !in_array(strtolower($palavra), $conectivos)) {
            // Se não for conectivo, ou se for a primeira palavra, capitaliza
            $palavras[$key] = ucfirst(strtolower($palavra));
        } else {
            // Se for conectivo, deixa em minúsculo
            $palavras[$key] = strtolower($palavra);
        }
    }

    // Junta as palavras de volta em uma string
    return implode(' ', $palavras);
}


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
<?php include('../modular/nav/nav.php'); ?>

<aside>
    <div class="aside-container">
        <h2>Departamento</h2>
        <select name="departamento" id="departamento">
            <?php
                echo '<option value="all">Todos os Produtos</option>';
            if ($result_departamentos->num_rows > 0) {
                // Loop para preencher as opções dinamicamente
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
                    <input id="fromSlider" type="range" value="0" min="0" max="12000" />
                    <input id="toSlider" type="range" value="12000" min="0" max="12000" />
                </div>
                <div class="form_control">
                    <div class="form_control_container">
                        <div class="form_control_container__time">Min</div>
                        <input class="form_control_container__time__input" type="number" id="fromInput" value="0" min="0" max="12000" />
                    </div>
                    <div class="form_control_container">
                        <div class="form_control_container__time">Max</div>
                        <input class="form_control_container__time__input" type="number" id="toInput" value="1200" min="0" max="12000" />
                    </div>
                </div>
            </div>
        </div>

        <div class="ofertas">
            <h2>Ofertas e Descontos</h2>
            <div class="oferta-diaria ctr pd-5px">
                <input type="checkbox" id="ofertas" class="ui-checkbox">
                <label for="ofertas">Oferta Diária</label>
            </div>
            <div class="desc ctr pd-5px">
                <input type="checkbox" id="descontos" class="ui-checkbox">
                <label for="descontos">Todos os Descontos</label>
            </div>
        </div>

        <div class="opcoes">
            <h2>Frete e GoExpress</h2>
            <div class="free ctr pd-5px">
                <input type="checkbox" id="frete" class="ui-checkbox">
                <label for="frete">Frete Grátis</label>
            </div>
            <div class="express-frete ctr pd-5px">
                <input type="checkbox" id="express" class="ui-checkbox">
                <label for="express">GoExpress</label>
            </div>
        </div>

        <div class="aplicar">
            <button id="aplicar">Aplicar</button>
        </div>
    </div>


</aside>











<?php //include('../modular/footer/footer.php'); ?>


<script src="scripts/categoria.js"></script>

</body>
</html>