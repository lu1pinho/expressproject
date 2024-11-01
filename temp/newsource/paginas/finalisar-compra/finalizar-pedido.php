<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

$enderecoCompleto = "";
$erro = "";
$frete = 0;

$id_user = $_SESSION['id'];

// Consulta para buscar o endereço do usuário logado
$stmt = $conn->prepare("SELECT endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();
$endereco = $result->fetch_assoc();

if ($endereco) {
    $enderecoCompleto = htmlspecialchars("{$endereco['endereco']} {$endereco['numero']}, {$endereco['bairro']} - {$endereco['cidade']}, {$endereco['estado']}");
    $frete = calcularFrete($endereco['cep']);
} else {
    $erro = "Endereço não encontrado para este usuário.";
}
$stmt->close();

$total_geral = 0;

// Função para calcular o frete com base no CEP
function calcularFrete($cep)
{
    global $conn;

    $cep = preg_replace('/\D/', '', $cep);

    $sql = "SELECT valor FROM frete WHERE cep = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $cep);
    $stmt->execute();
    $stmt->bind_result($valorFrete);

    if ($stmt->fetch()) {
        $stmt->close();
        return floatval($valorFrete);
    } else {
        $stmt->close();
        return 0;
    }
}

// Busca os produtos no carrinho
$stmt = $conn->prepare("SELECT produto_nome, url_img, preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$produtos = $stmt->get_result();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar Pedido - Express.com</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="finalizar-pedido.css">
</head>

<body>
    <header>
        <div class="banner">
            <div class="logo">
                <img src="../principal/images/logo/logo.png" alt="Express.com">
            </div>
            <div class="butao-voltar">
                <a href="../produto-individual/carrinho.php">
                    <button class="btn-voltar">Voltar</button>
                </a>
            </div>
        </div>
    </header>

    <div class="container-wrapper">
        <section class="entrega-container">
            <h2>Forma de entrega</h2>
            <?php if ($erro): ?>
                <p class="erro"><?php echo $erro; ?></p>
            <?php else: ?>
                <div class="entrega-opcao">
                    <p class="endereco-texto"><?php echo $enderecoCompleto; ?></p>
                </div>
                <a href="../dados-do-usuário/dados-usuario.php">
                    <button class="btn-editar">Editar ou escolher outro endereço</button>
                </a>
            <?php endif; ?>
        </section>

        <article class="carrinho-container">
            <h2>Seu Carrinho</h2>
            <?php if ($produtos->num_rows > 0): ?>
                <?php
                $total_produtos = 0;
                while ($row = $produtos->fetch_assoc()):
                    $nome_produto = htmlspecialchars($row['produto_nome']);
                    $url_img = htmlspecialchars($row['url_img']);
                    $preco = $row['preco_com_desconto'] ?: $row['preco'];
                    $quantidade = $row['quantidade'];
                    $total_item = $preco * $quantidade;
                    $total_produtos += $total_item;
                ?>
                    <article class="produto-carrinho">
                        <div class="produto-imagem">
                            <img src="<?php echo $url_img; ?>" alt="<?php echo $nome_produto; ?>">
                        </div>
                        <div class="produto-info">
                            <h3><?php echo $nome_produto; ?></h3>
                            <p>Preço: R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>
                            <div class="quantidade-produto">
                                <label>Quantidade:</label>
                                <input type="text" value="<?php echo htmlspecialchars($quantidade); ?>" size="2" readonly>
                            </div>
                            <p>Total: R$ <?php echo number_format($total_item, 2, ',', '.'); ?></p>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Seu carrinho está vazio.</p>
            <?php endif; ?>
        </article>

        <!-- Seção do resumo da compra -->
        <section class="resumo-compra-container">
            <h2>Resumo da compra</h2>
            <div class="preco-detalhe">
                <p>Subtotal dos produtos</p>
                <p>R$ <?php echo number_format($total_produtos, 2, ',', '.'); ?></p>
            </div>
            <div class="preco-detalhe">
                <p>Frete</p>
                <p>R$ <?php echo number_format($frete, 2, ',', '.'); ?></p>
            </div>
            <div class="total">
                <p>Total</p>
                <p>R$ <?php echo number_format($total_produtos + $frete, 2, ',', '.'); ?></p>
            </div>
            <a href="../finalisar-compra/forma-de-pagamento.php">
                <button class="btn-continuar">Continuar a compra</button>
            </a>
        </section>
    </div>
</body>

</html>