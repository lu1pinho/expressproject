<?php
require_once 'C:/xampp/htdocs/expressproject/vendor/autoload.php'; // Caminho absoluto

use Dotenv\Dotenv;

// Carregar o arquivo .env
$dotenv = Dotenv::createImmutable('C:/xampp/htdocs/expressproject'); // Caminho absoluto
$dotenv->load();

// Acessar as variáveis de ambiente
$servidor = $_ENV['DB_HOST'];
$banco = $_ENV['DB_NAME'];
$usuario = $_ENV['DB_USER'];
$porta = $_ENV['DB_PORT'];
$senha = $_ENV['DB_PASS'];

try {
    // Criar a conexão com o banco de dados
    $conn = new mysqli($servidor, $usuario, $senha, $banco, $porta);

    // Verificar se a conexão foi bem-sucedida
    if ($conn->connect_errno) {
        throw new Exception("Conexão falhou: (" . $conn->connect_errno . ") " . $conn->connect_error);
    }
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}
?>
