<?php

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="../view/vendedor/modular/sidebar/sidebar.css">
    <link rel="stylesheet" href="../view/faturamento.css">
    <title>Faturamento</title>
</head>
<body>
<?php include_once '../view/vendedor/modular/sidebar/sidebar.php'; ?>

<main>
    <section>
        <article class="sealer-header">
            <h3>Ei <?php echo $_SESSION['nome']; ?>, veja o seu faturamento</h3>
            <p>Acompanhe seus lucros e os seus produtos mais vendidos.</p>
            <hr>
        </article>
    </section>

    <section>
        <article class="faturamento">
            <h2>Faturamento</h2>
            <div class="faturamento-info">
                <div class="produtos-vendidos">
                    <div class="right">
                        <p>R$ <?= number_format($totalVendido, 2, ',', '.') ?></p>
                        <p>em produtos vendidos.</p>
                    </div>
                    <div class="left">
                        <p><?php echo $totalProdutosVendidos; ?></p>
                        <p>produtos vendidos.</p>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <section>
        <article class="">
            <h2>Produtos mais Vendidos</h2>
            <div class="graph">
                <div id="barchart_material" style="width: 800px; height: 350px;"></div>

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Produto', 'Vendas'],
                            <?php
                            // Aqui você irá gerar as linhas para o gráfico
                            foreach ($topProdutos as $produto) {
                                echo "['" . $produto['nome'] . "', " . $produto['total_vendas'] . "],";
                            }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: 'Número de Vendas por Produto',
                            },
                            bars: 'horizontal'
                        };

                        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
            </div>
        </article>
    </section>
</main>



<script>
    function closePopup() {
        document.querySelector('.popup').style.visibility = 'hidden'; // Oculta o popup
        document.querySelector('.backdrop').style.visibility = 'hidden'; // Oculta o backdrop
    }

    // Para abrir o popup
    function openPopup() {
        document.querySelector('.popup').style.visibility = 'visible'; // Exibe o popup
        document.querySelector('.backdrop').style.visibility = 'visible'; // Exibe o backdrop
    }

    function encerrarSessao() {
        window.location.href = '/expressproject/control/control_logout.php';
    }

</script>
</body>
</html>
