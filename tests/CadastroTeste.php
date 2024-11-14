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

    // Teste para o método createUser com sucesso
    public function testCreateUserSuccess() {
        // Configuração do statement mockado
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')
                 ->willReturn(true);

        // Configuração do método prepare para retornar o statement mockado
        $this->conn->method('prepare')
                   ->willReturn($stmtMock);

        // Executar o método e verificar o resultado
        $result = $this->model->createUser('Usuário Teste', '123456789', 'Cliente', 'teste@example.com', 'senha123');
        $this->assertTrue($result);
    }

    // Teste para o método createUser com falha
    public function testCreateUserFailure() {
        // Configuração do statement mockado para falha na execução
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')
                 ->willReturn(false);

        // Configuração do método prepare para retornar o statement mockado
        $this->conn->method('prepare')
                   ->willReturn($stmtMock);

        // Executar o método e verificar que ele retorne falso
        $result = $this->model->createUser('Usuário Teste', '123456789', 'Cliente', 'teste@example.com', 'senha123');
        $this->assertFalse($result);
    }

    // Teste para o método checkEmailExists com email existente
    public function testCheckEmailExistsTrue() {
        // Mock do ResultSet para simular que o email existe
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('num_rows')
                   ->willReturn(1); // Simula que o email existe

        // Configuração do statement mockado
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('get_result')
                 ->willReturn($resultMock);

        // Configuração do método prepare para retornar o statement mockado
        $this->conn->method('prepare')
                   ->willReturn($stmtMock);

        // Executar o método e verificar que ele retorne true
        $result = $this->model->checkEmailExists('teste@example.com');
        $this->assertTrue($result);
    }

    // Teste para o método checkEmailExists com email inexistente
    public function testCheckEmailExistsFalse() {
        // Mock do ResultSet para simular que o email não existe
        $resultMock = $this->createMock(mysqli_result::class);
        $resultMock->method('num_rows')
                   ->willReturn(0); // Simula que o email não existe

        // Configuração do statement mockado
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('get_result')
                 ->willReturn($resultMock);

        // Configuração do método prepare para retornar o statement mockado
        $this->conn->method('prepare')
                   ->willReturn($stmtMock);

        // Executar o método e verificar que ele retorne false
        $result = $this->model->checkEmailExists('naoexiste@example.com');
        $this->assertFalse($result);
    }
}
