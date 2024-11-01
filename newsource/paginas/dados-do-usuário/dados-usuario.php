<?php
session_start();
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['id'];

$sql = "SELECT id, nome, email, genero, cpf, telefone, dt_nascimento FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $email = $row['email'];
    $genero = $row['genero'];
    $cpf = $row['cpf'];
    $telefone = $row['telefone'];
    $dt_nascimento = $row['dt_nascimento'];
} else {
    echo 'Erro! Usuário não encontrado.';
    exit();
}

//-----------------------------------------------DADOS PESSOAIS - FIM -------------------------------------------------------
$sql = "SELECT id_end, endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$end = $result->fetch_assoc();

if ($end) {
    // echo "Tem";
    $id_end = $end['id_end'];
    $endereco = $end['endereco'];
    $bairro = $end['bairro'];
    $complemento = $end['complemento'];
    $numero = $end['numero'];
    $cep = $end['cep'];
    $cidade = $end['cidade'];
    $estado = $end['estado'];
} else {
    //echo "N tem";
    $endereco = '';
    $bairro = '';
    $complemento = '';
    $numero = '';
    $cep = '';
    $cidade = '';
    $estado = '';
}

//-----------------------------------------------ENDERECO - FIM -------------------------------------------------------
$sql = "SELECT id_cartao, nome_cartao, apelido, numero_cartao, dt_expedicao, cvv, categoria_cartao FROM cartoes WHERE id_user= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();
//var_dump($car);

if ($car) {
    //echo "Tem";
    $id_cartao = $car['id_cartao'];
    $nome_cartao = $car['nome_cartao'];
    $apelido = $car['apelido'];
    $numero_cartao = $car['numero_cartao'];
    $dt_expedicao = $car['dt_expedicao'];
    $cvv = $car['cvv'];
    $categoria_cartao = $car['categoria_cartao'];
} else {
    //echo "N tem";
    $id_cartao = '';
    $nome_cartao = '';
    $apelido = '';
    $numero_cartao = '';
    $dt_expedicao = '';
    $cvv = '';
    $categoria_cartao = '';
}
//-----------------------------------------------CARTAO - FIM -------------------------------------------------------

if (isset($_POST['atualizar'])) {
    // Coletando dados de endereço
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $bairro = $conn->real_escape_string($_POST['bairro']);
    $complemento = $conn->real_escape_string($_POST['complemento']);
    $numero = $conn->real_escape_string($_POST['numero']);
    $cep = $conn->real_escape_string($_POST['cep']);
    $cidade = $conn->real_escape_string($_POST['cidade']);
    $estado = $conn->real_escape_string($_POST['estado']);
    $id_user = $_SESSION['id'];

    // Atualizando ou inserindo o endereço
    if ($end) {
        $sql = "UPDATE enderecos SET endereco = ?, bairro = ?, complemento = ?, numero = ?, cep = ?, cidade = ?, estado = ? WHERE id_end = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisssi", $endereco, $bairro, $complemento, $numero, $cep, $cidade, $estado, $id_end);
    } else {
        $sql = "INSERT INTO enderecos (endereco, bairro, complemento, numero, cep, cidade, estado, id_user) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssisssi", $endereco, $bairro, $complemento, $numero, $cep, $cidade, $estado, $id_user);
    }

    // Coletando os dados de usuário
    $nome = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $genero = $conn->real_escape_string($_POST['genero']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $telefone = $conn->real_escape_string($_POST['phone']);
    $dt_nascimento = $conn->real_escape_string($_POST['dt-nascimento']);

    // Atualizando os dados do usuário
    $sql = "UPDATE users SET nome = ?, email = ?, genero = ?, cpf = ?, telefone = ?, dt_nascimento = ? WHERE id = ?";
    $stmt2 = $conn->prepare($sql);
    $stmt2->bind_param("ssssssi", $nome, $email, $genero, $cpf, $telefone, $dt_nascimento, $id_user);

    // Coletando os dados do cartão
    $nome_cartao = $conn->real_escape_string($_POST['nome_cartao']);
    $apelido = $conn->real_escape_string($_POST['apelido']);
    $numero_cartao = $conn->real_escape_string($_POST['numero_cartao']);
    $dt_expedicao = $conn->real_escape_string($_POST['dt_expedicao']);
    $cvv = $conn->real_escape_string($_POST['cvv']);
    $categoria_cartao = $conn->real_escape_string($_POST['categoria_cartao']);

    // Atualizando ou inserindo o cartão
    if ($car) {
        $sql = "UPDATE cartoes SET nome_cartao = ?, apelido = ?, numero_cartao = ?, dt_expedicao = ?, cvv = ?, categoria_cartao = ? WHERE id_cartao = ?";
        $stmt3 = $conn->prepare($sql);
        $stmt3->bind_param("ssssisi", $nome_cartao, $apelido, $numero_cartao, $dt_expedicao, $cvv, $categoria_cartao, $id_cartao);
    } else {
        $sql = "INSERT INTO cartoes (nome_cartao, apelido, numero_cartao, dt_expedicao, cvv, categoria_cartao, id_user) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt3 = $conn->prepare($sql);
        $stmt3->bind_param("ssssisi", $nome_cartao, $apelido, $numero_cartao, $dt_expedicao, $cvv, $categoria_cartao, $id_user);
    }

    // Executando e verificando se foram bem-sucedidas
    if ($stmt->execute() && $stmt2->execute() && $stmt3->execute()) {
        // Redirecionando para a página com os dados atualizados
        header('Location: dados-usuario.php');
        exit;
    } else {
        echo "Erro: " . $stmt1->error . " " . $stmt2->error . " " . $stmt3->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Express.com</title>
    <link rel="stylesheet" href="../dados-do-usuário/dados-usuario.css">
</head>

<body>
    <header>
        <div class="banner">
            <div class="logo">
                <img src="../principal/images/logo/logo.png" alt="Express.com">
            </div>
            <div class="butao-voltar">
                <a href="../principal/pagina.php">
                    <button class="btn-voltar" onclick="window.history.back();">Voltar</button>
                </a>
            </div>
        </div>
    </header>
    <div class="apresentacao">
        <form class="caixa_fundo" method="POST" action="dados-usuario.php">

            <p class="titulo">Sua conta</p>
            <div class="dados">
                <div class="sub">
                    <label for="name" class="campos">Nome:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($nome); ?>" class="bordas" required>

                    <label for="email" class="campos">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="bordas" required>

                    <label for="genero" class="campos">Gênero:</label>
                    <select id="genero" name="genero" class="bordas" required>
                        <option value="">Selecione</option>
                        <option value="Feminino" <?php echo ($genero == 'Feminino') ? 'selected' : ''; ?>>Feminino</option>
                        <option value="Masculino" <?php echo ($genero == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                    </select>
                </div>
                <div class="sub">
                    <label for="cpf" class="campos">CPF:</label>
                    <input type="cpf" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" placeholder="  _ _ _ . _ _ _ . _ _ _ - _ _" class="bordas" required>

                    <label for="phone" class="campos">Telefone:</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($telefone); ?>" placeholder="  (_ _) _ _ _ _ _ - _ _ _ _" class="bordas" required>

                    <label for="dt-nascimento" class="campos">Data de nascimento:</label>
                    <input type="text" id="dt-nascimento" name="dt-nascimento" value="<?php echo htmlspecialchars($dt_nascimento); ?>" placeholder="  _ _ / _ _ / _ _ _ _" class="bordas" required>
                </div>
            </div>

            <p class="titulo">Seu endereço</p>
            <div class="dados">
                <div class="sub">
                    <label for="endereco" class="campos">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>" class="bordas" required>

                    <label for="bairro" class="campos">Bairro:</label>
                    <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($bairro); ?>" class="bordas" required>

                    <label for="complemento" class="campos">Complemento:</label>
                    <input type="text" id="complemento" name="complemento" value="<?php echo htmlspecialchars($complemento); ?>" class="bordas" required>

                    <label for="numero" class="campos">Nº residência:</label>
                    <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($numero); ?>" class="bordas" required>
                </div>
                <div class="sub">
                    <label for="cep" class="campos">CEP:</label>
                    <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($cep); ?>" placeholder="  _ _ _ _ _ - _ _ _" class="bordas" required>

                    <label for="cidade" class="campos">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" class="bordas" required>

                    <label for="estado" class="campos">Estado:</label>
                    <select id="estado" name="estado" value="<?php echo htmlspecialchars($estado); ?>" class="bordas" required>
                        <option value="">Selecione</option>
                        <option value="AC" <?php echo ($estado == 'AC') ? 'selected' : ''; ?>>AC</option>
                        <option value="AL" <?php echo ($estado == 'AL') ? 'selected' : ''; ?>>AL</option>
                        <option value="AP" <?php echo ($estado == 'AP') ? 'selected' : ''; ?>>AP</option>
                        <option value="AM" <?php echo ($estado == 'AM') ? 'selected' : ''; ?>>AM</option>
                        <option value="BA" <?php echo ($estado == 'BA') ? 'selected' : ''; ?>>BA</option>
                        <option value="CE" <?php echo ($estado == 'CE') ? 'selected' : ''; ?>>CE</option>
                        <option value="DF" <?php echo ($estado == 'DF') ? 'selected' : ''; ?>>DF</option>
                        <option value="ES" <?php echo ($estado == 'ES') ? 'selected' : ''; ?>>ES</option>
                        <option value="GO" <?php echo ($estado == 'GO') ? 'selected' : ''; ?>>GO</option>
                        <option value="MA" <?php echo ($estado == 'MA') ? 'selected' : ''; ?>>MA</option>
                        <option value="MT" <?php echo ($estado == 'MT') ? 'selected' : ''; ?>>MT</option>
                        <option value="MS" <?php echo ($estado == 'MS') ? 'selected' : ''; ?>>MS</option>
                        <option value="MG" <?php echo ($estado == 'MG') ? 'selected' : ''; ?>>MG</option>
                        <option value="PA" <?php echo ($estado == 'PA') ? 'selected' : ''; ?>>PA</option>
                        <option value="PB" <?php echo ($estado == 'PB') ? 'selected' : ''; ?>>PB</option>
                        <option value="PR" <?php echo ($estado == 'PR') ? 'selected' : ''; ?>>PR</option>
                        <option value="PE" <?php echo ($estado == 'PE') ? 'selected' : ''; ?>>PE</option>
                        <option value="PI" <?php echo ($estado == 'PI') ? 'selected' : ''; ?>>PI</option>
                        <option value="RJ" <?php echo ($estado == 'RJ') ? 'selected' : ''; ?>>RJ</option>
                        <option value="RN" <?php echo ($estado == 'RN') ? 'selected' : ''; ?>>RN</option>
                        <option value="RS" <?php echo ($estado == 'RS') ? 'selected' : ''; ?>>RS</option>
                        <option value="RO" <?php echo ($estado == 'RO') ? 'selected' : ''; ?>>RO</option>
                        <option value="RR" <?php echo ($estado == 'RR') ? 'selected' : ''; ?>>RR</option>
                        <option value="SC" <?php echo ($estado == 'SC') ? 'selected' : ''; ?>>SC</option>
                        <option value="SP" <?php echo ($estado == 'SP') ? 'selected' : ''; ?>>SP</option>
                        <option value="SE" <?php echo ($estado == 'SE') ? 'selected' : ''; ?>>SE</option>
                        <option value="TO" <?php echo ($estado == 'TO') ? 'selected' : ''; ?>>TO</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="id_end" value="<?php echo $id_end; ?>">


            <p class="titulo">Seu cartão</p>
            <div class="dados">
                <div class="sub">
                    <label for="nome_cartao" class="campos">Nome:</label>
                    <input type="text" id="nome_cartao" name="nome_cartao" value="<?php echo htmlspecialchars($nome_cartao); ?>" class="bordas" required>

                    <label for="apelido" class="campos">Apelido:</label>
                    <input type="text" id="apelido" name="apelido" value="<?php echo htmlspecialchars($apelido); ?>" class="bordas" required>

                    <label for="numero_cartao" class="campos">Número:</label>
                    <input type="text" id="numero_cartao" name="numero_cartao" value="<?php echo htmlspecialchars($numero_cartao); ?>" class="bordas" required>
                </div>
                <div class="sub">
                    <label for="categoria_cartao" class="campos">Tipo:</label>
                    <select id="categoria_cartao" name="categoria_cartao" value="<?php echo htmlspecialchars($categoria_cartao); ?>" class="bordas" required>
                        <option value="">Selecione</option>
                        <option value="credito" <?php echo ($categoria_cartao == 'credito') ? 'selected' : ''; ?>>Crédito</option>
                        <option value="debito" <?php echo ($categoria_cartao == 'debito') ? 'selected' : ''; ?>>Débito</option>
                    </select>

                    <label for="dt_expedicao" class="campos">Data de expedição:</label>
                    <input type="text" id="dt_expedicao" name="dt_expedicao" value="<?php echo htmlspecialchars($dt_expedicao); ?>" placeholder="  _ _ / _ _ / _ _ _ _" class="bordas" required>

                    <label for="cvv" class="campos">CVV:</label>
                    <input type="text" id="cvv" name="cvv" value="<?php echo htmlspecialchars($cvv); ?>" placeholder="  _ _ _ " class="bordas" required>
                </div>
            </div>

            <input type="hidden" name="id_cartao" value="<?php echo $id_cartao; ?>">

            <button type="submit" name="atualizar" class="botoes">Atualizar</button>

        </form>
    </div>
</body>

</html>