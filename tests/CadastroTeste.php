<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../model/cadastro.php';

class CadastroTeste extends TestCase {
    private $model;
    private $conn;

    protected function setUp(): void {
        // Mock da conexão com o banco de dados
        $this->conn = $this->createMock(mysqli::class);

        // Inicializar o modelo com a conexão mockada
        $this->model = new UserModel($this->conn);
    }

    // Teste para email já existente
    public function testCheckEmailExistsTrue() {
        // Mock do mysqli_result
        $resultMock = $this->createMock(mysqli_result::class);

        // Configuração para simular um resultado com registros (num_rows > 0)
        $resultMock->method('num_rows')->willReturn(1);

        // Mock do mysqli_stmt para retornar o resultado
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('get_result')->willReturn($resultMock);

        // Configurando a conexão para retornar o statement mockado
        $this->conn->method('prepare')->willReturn($stmtMock);

        // Executar o método e verificar o resultado
        $result = $this->model->checkEmailExists('teste@example.com');
        $this->assertTrue($result);
    }

    // Teste para email não existente
    public function testCheckEmailExistsFalse() {
        // Mock do mysqli_result
        $resultMock = $this->createMock(mysqli_result::class);

        // Configuração para simular um resultado vazio (num_rows = 0)
        $resultMock->method('num_rows')->willReturn(0);

        // Mock do mysqli_stmt para retornar o resultado
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('get_result')->willReturn($resultMock);

        // Configurando a conexão para retornar o statement mockado
        $this->conn->method('prepare')->willReturn($stmtMock);

        // Executar o método e verificar o resultado
        $result = $this->model->checkEmailExists('naoexistente@example.com');
        $this->assertFalse($result);
    }
}
