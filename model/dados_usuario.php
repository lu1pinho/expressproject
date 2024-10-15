<?php
session_start();
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';
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

    $sql = "SELECT id_end, endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $end = $result->fetch_assoc();

    if($end){ 
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
    $sql = "SELECT id_cartao, nome_cartao, apelido, numero_cartao, dt_expedicao, cvv, categoria_cartao FROM cartoes WHERE id_user= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();
    //var_dump($car);

    if($car){
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