<?php
require_once 'C:/xampp/htdocs/expressproject/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('C:/xampp/htdocs/expressproject');
$dotenv->load();

$servidor = $_ENV['DB_HOST'];
$banco = $_ENV['DB_NAME'];
$usuario = $_ENV['DB_USER'];
$porta = $_ENV['DB_PORT'];
$senha = $_ENV['DB_PASS'];

try {
    // Criar a conexão
    $conn = new mysqli($servidor, $usuario, $senha, $banco, $porta);

    // Verificar se a conexão falhou
    if ($conn->connect_errno) {
        throw new Exception("Conexão falhou: (" . $conn->connect_errno . ") " . $conn->connect_error);
    } else {
        //echo 'conectou!';
    }
    
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
