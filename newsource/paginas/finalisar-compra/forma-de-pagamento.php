<?php
// Incluir o arquivo de conexão com o banco de dados
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

// Iniciar a sessão para acessar o id do usuário logado
session_start();

$id_usuario = $_SESSION['id']; // Pegar o id do usuário logado da sessão

// Inicializando variáveis de resumo de pedido
$frete = 0;
$total_produtos = 0;

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

// 1. BUSCAR O ENDEREÇO E CALCULAR O FRETE
// Consulta para buscar o CEP do endereço do usuário logado
$stmt = $conn->prepare("SELECT cep FROM enderecos WHERE id_user = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$endereco = $result->fetch_assoc();

if ($endereco) {
    // Calcula o frete com base no CEP do usuário
    $frete = calcularFrete($endereco['cep']);
}

$stmt->close();

// 2. BUSCAR OS PRODUTOS NO CARRINHO
// Consulta para buscar os produtos no carrinho do usuário
$stmt = $conn->prepare("SELECT preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Calcula o total dos produtos no carrinho
while ($row = $result->fetch_assoc()) {
    $preco = $row['preco'];
    $preco_com_desconto = $row['preco_com_desconto'];
    $quantidade = $row['quantidade'];
    $preco_final = $preco_com_desconto ?: $preco;
    $total_produtos += $preco_final * $quantidade;
}

$stmt->close();

// 3. BUSCAR OS CARTÕES DO USUÁRIO
// Consulta para buscar os cartões do usuário logado
$sql = "SELECT * FROM cartoes WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verificar se existem cartões para o usuário
if ($result->num_rows > 0) {
    // Armazenar os cartões em um array
    $cartoes = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $cartoes = [];
}

$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forma de pagamento</title>
    <link rel="stylesheet" href="../finalisar-compra/forma-de-pagamento.css">
</head>

<body>

    <header>
        <div class="banner">
            <div class="logo">
                <img src="../principal/images/logo/logo.png" alt="Express.com">
            </div>
            <div class="butao-voltar">
                <a href="../finalisar-compra/finalizar-pedido.php">
                    <button class="btn-voltar" onclick="window.history.back();">Voltar</button>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <h2>Cartões Cadastrados</h2>

        <?php if (!empty($cartoes)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome Cartão</th>
                        <th>Apelido</th>
                        <th>Número do Cartão</th>
                        <th>Data de Expedição</th>
                        <th>CVV</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartoes as $cartao): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cartao['nome_cartao']); ?></td>
                            <td><?php echo htmlspecialchars($cartao['apelido']); ?></td>
                            <td><?php echo htmlspecialchars($cartao['numero_cartao']); ?></td>
                            <td><?php echo htmlspecialchars($cartao['dt_expedicao']); ?></td>
                            <td><?php echo htmlspecialchars($cartao['cvv']); ?></td>
                            <td><?php echo htmlspecialchars($cartao['categoria_cartao']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Não há cartões cadastrados para este usuário.</p>
        <?php endif; ?>
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
        </div>
        <a href="">
            <button class="btn-continuar">Comprar</button>

        </a>
    </section>

</body>

</html>