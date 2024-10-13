<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Incluindo conexão
include_once 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
// Define o caminho para as imagens
define('CAMINHO_IMAGENS', '../../produtos/');
// Verificando a conexão
if (empty($conn) || $conn->connect_error) {
    die("Falha na conexão: " . (isset($conn->connect_error) ? $conn->connect_error : "Conexão não estabelecida."));
}

// Preparando a consulta
$sql = "SELECT id, nome, dados_produto, descricao, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Erro na preparação da consulta: ' . $conn->error);
}

// Vinculando e executando a consulta
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($id, $nome, $dados, $descricao, $preco, $precodesconto, $percentual_desconto, $url_img);
if (!$stmt->fetch()) {
    // Redireciona para a página de erro 404
//    header("Location: /expressproject/error404/error404.html");
//    exit(); // Interrompe a execução do script
}

// Calculando o preço com desconto
if (empty($precodesconto)) {
    $precodesconto = !empty($percentual_desconto)
        ? $preco - (($percentual_desconto / 100) * $preco)
        : $preco;
}

// Calculando a porcentagem de desconto
$porcentagem = ($precodesconto < $preco) ? round(100 - (($precodesconto / $preco) * 100)) : 0;

$stmt->close();

// Função para formatar texto
require 'C:\xampp\htdocs\expressproject\vendor\erusev\parsedown\Parsedown.php';

function formatText($text) {
    // Permitir apenas algumas tags HTML
    $allowed_tags = '<h1><h2><h3><p><strong><em><div><br><ul><li>'; // Adicione outras tags que você deseja permitir
    $parsedown = new Parsedown();
    // Converte Markdown para HTML
    $html = $parsedown->text($text);
    // Retorna HTML sanitizado com nl2br para que quebras de linha sejam mantidas
    return nl2br(strip_tags($html, $allowed_tags));
}

function dividirPor10($valor) {
    // Verifica se o valor é numérico e maior que 0
    if (is_numeric($valor) && $valor > 0) {
        return number_format($valor / 10, 2, ',', '.'); // Formata o valor para duas casas decimais
    }
    return '0,00'; // Retorna '0,00' caso o valor não seja válido
}


// Consultando produtos recomendados
$recommended_sql = "SELECT id, nome, preco, preco_com_desconto, percentual_desconto, url_img FROM produtos WHERE id != ? LIMIT 3";
$recommended_stmt = $conn->prepare($recommended_sql);
$recommended_stmt->bind_param("i", $id);
$recommended_stmt->execute();
$recommended_stmt->bind_result($rec_id, $rec_nome, $rec_preco, $rec_precodesconto, $rec_percentual_desconto, $rec_url_img);

$recommended_products = [];
while ($recommended_stmt->fetch()) {
    $recommended_products[] = [
        'id' => $rec_id,
        'nome' => $rec_nome,
        'preco' => $rec_preco,
        'precodesconto' => $rec_precodesconto,
        'percentual_desconto' => $rec_percentual_desconto,
        'url_img' => $rec_url_img,
    ];
}
$recommended_stmt->close();
session_start();
function logout() {
    session_destroy();
}

if (isset($_POST['logout'])) {
    logout(); 
}
?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../produto-individual/stylesheets/produto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title><?php echo htmlspecialchars($nome); ?></title>
</head>
<body>
    <?php include 'nav.php'?>

    <main>
        <div class="product-container">
            <div class="product-image">
                <img id="product-img" src="../../produtos/<?php echo htmlspecialchars($url_img); ?>" alt="iPhone 16">
            </div>

            <div class="product-info">
                <h1><?php echo htmlspecialchars($nome); ?></h1>
                <div class="values">
                    <div class="price">
                        <span>R$ <?php echo number_format($preco, 2, ',', '.'); ?></span>
                        <p>R$ <?php echo number_format($precodesconto, 2, ',', '.'); ?></p>
                        <span>em até 10x de <?php echo htmlspecialchars(dividirPor10($precodesconto)); ?> sem juros no Cartão Express.</span>
                    </div>
                    <div class="discount">
                        <p><?php echo htmlspecialchars($porcentagem); ?>% de desconto comprando agora no PIX!</p>
                    </div>
                </div>
                <div class="short-description">
                    <ul>
                        <li><?php echo formatText($dados); ?></li>
                    </ul>
                </div>
                <div class="popup-cart">
                    <p>Adicionado Ao Carrinho!</p>
                </div>
                <!-- Adicionando ao carrinho -->
                <form action="carrinho.php" method="POST">
                <input type="hidden" name="produto_nome" value="<?php echo htmlspecialchars($nome); ?>">
                <div class="product-image">
                    <input type="hidden" name="produto_imagem" value="<?php echo CAMINHO_IMAGENS . htmlspecialchars($url_img); ?>">
                </div>
                <input type="hidden" name="produto_preco" value="<?php echo htmlspecialchars($preco); ?>"> <!-- Mantendo o valor original -->
                <input type="hidden" name="produto_preco_desconto" value="<?php echo htmlspecialchars($precodesconto); ?>"> <!-- Preço com desconto -->
                <div class="buy">
                    <button style="margin-top:30px" >Comprar</button>
                <div class="up" >
                <select style="margin-bottom: 10px; margin-left: 5px" name="quantidade" id="quantidade" value="1" min="1" required>
                <option value="1" selected>Quantidade: 1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                </select>
                    <button id="addcart">Adicionar Ao Carrinho</button>
                </div>
                </div>
                </form>
                <div class="favorite">
                    <img class="love-icon" src="../produto-individual/img/svg/heart-thin-icon.svg" alt="Favoritar" width="30px">
                </div>
            </div>
        </div>

        <div class="product-full-description">
            <h2 id="text-desc">Descrição do Produto</h2>
            <div class="description">
                <?php echo formatText($descricao); ?>
            </div>

        </div>
    </main>


    <footer>
        <div class="footer-container">

            <div class="footer-item">
                <img src="../principal/images/logo/logopreta.png" alt="Logo Express">
            </div>

            <div class="footer-item">
                <h3>Atendimento ao Cliente</h3>
                <a href="#">Central de Atendimento</a>
                <a href="#">Como Comprar</a>
                <a href="#">Formas de Pagamento</a>
                <a href="#">Política de Privacidade</a>
                <a href="#">Política de Troca e Devolução</a>
            </div>

            <div class="footer-item">
                <h3>Express Marketplace</h3>
                <a href="#">Quem Somos</a>
                <a href="#">Trabalhe Conosco</a>
                <a href="#">Seja um Parceiro</a>
            </div>

            <div class="footer-item">
                <h3>Minha Conta</h3>
                <a href="#">Meus Pedidos</a>
                <a href="#">Meus Dados</a>
                <a href="#">Meus Endereços</a>
            </div>
            <div class="footer-item">
                <h3>Formas de Pagamento</h3>
                <a href="#">Cartões Visa e MasterCard</a>
                <a href="#">Pagamento por Pix</a>
                <a href="#">Apple Pay e PayPal</a>
                <img class="payments" src="../principal/images/svg/paymentmethods.png" alt="Formas de Pagamento">
            </div>
        </div>
    </footer>

    <script src="scripts/produto.js"></script>
</body>
</html>
