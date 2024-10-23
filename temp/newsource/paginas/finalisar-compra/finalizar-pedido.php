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
$frete = 0; // Inicializando o valor do frete

if (isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];

    // Consulta para buscar o endereço do usuário logado
    $stmt = $conn->prepare("SELECT endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?");
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $endereco = $result->fetch_assoc();

    if ($endereco) {
        $enderecoCompleto = htmlspecialchars($endereco['endereco']) . " " . htmlspecialchars($endereco['numero']) . ", " . htmlspecialchars($endereco['bairro']) . " - " . htmlspecialchars($endereco['cidade']) . ", " . htmlspecialchars($endereco['estado']);

        // Função para calcular o frete com base no CEP do usuário
        $frete = calcularFrete($endereco['cep']);
    } else {
        $erro = "Endereço não encontrado para este usuário.";
    }

    $stmt->close();
} else {
    $erro = "Usuário não está logado.";
}

$total_geral = 0; // Inicializando a variável total_geral com 0

// Função para calcular o frete com base no CEP
// Função para calcular o frete com base no CEP
function calcularFrete($cep)
{
    global $conn;

    // Remover caracteres não numéricos do CEP
    $cep = preg_replace('/\D/', '', $cep);

    // Verifica se a conexão está ativa
    if (!$conn) {
        die("Erro de conexão: " . mysqli_connect_error());
    }

    // Consulta ao banco de dados para o valor do frete
    $sql = "SELECT valor FROM frete WHERE cep = ?";
    $stmt = $conn->prepare($sql);

    // Verifique se a preparação da consulta foi bem-sucedida
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $cep);
    $stmt->execute();
    $stmt->bind_result($valorFrete);

    if ($stmt->fetch()) {
        $stmt->close();
        return floatval($valorFrete); // Garantir que retorna um valor numérico
    } else {
        $stmt->close();
        return 0; // Retorna 0 se o frete não for encontrado
    }
}



// Busca os produtos no carrinho
$stmt = $conn->prepare("SELECT produto_nome, url_img, preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
$stmt->bind_param("i", $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Fecha a consulta e a conexão
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
                    <button class="btn-voltar" onclick="window.history.back();">Voltar</button>
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
                <a href="dados-usuario.php">
                    <button class="btn-editar">Editar ou escolher outro endereço</button>
                </a>
            <?php endif; ?>
        </section>

        <article class="carrinho-container">
            <h2>Seu Carrinho</h2>

            <?php
            $total_produtos = 0; // Inicializa o total dos produtos
            if ($result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    $nome_produto = htmlspecialchars($row['produto_nome']);
                    $url_img = htmlspecialchars($row['url_img']);
                    $preco = $row['preco'];
                    $preco_com_desconto = $row['preco_com_desconto'];
                    $quantidade = $row['quantidade'];
                    $preco_final = $preco_com_desconto ?: $preco;
                    $total_item = $preco_final * $quantidade;
                    $total_produtos += $total_item; // Acumula o total dos produtos
            ?>
                    <article class="produto-carrinho">
                        <div class="produto-imagem">
                            <img src="<?php echo $url_img; ?>" alt="<?php echo $nome_produto; ?>">
                        </div>
                        <div class="produto-info">
                            <h3><?php echo $nome_produto; ?></h3>
                            <p>Preço: R$ <?php echo number_format($preco_final, 2, ',', '.'); ?></p>
                            <div class="quantidade-produto">
                                <label>Quantidade:</label>
                                <input type="text" value="<?php echo htmlspecialchars($quantidade); ?>" size="2" readonly>
                            </div>
                            <p>Total: R$ <?php echo number_format($total_item, 2, ',', '.'); ?></p>
                        </div>
                    </article>
            <?php
                endwhile;
            else:
                echo '<p>Seu carrinho está vazio.</p>';
            endif;
            ?>
        </article>
    </div>

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
        <button class="btn-continuar">Continuar a compra</button>
    </section>

</body>

</html>