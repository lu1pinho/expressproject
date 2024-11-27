<?php

use PHPUnit\Framework\TestCase;
use Model\AtualizarCadastroModel;

class AtualizarCadastroModelTest extends TestCase {
    private $model;
    private $conn;

    protected function setUp(): void {
        // Mock da conexão com o banco de dados
        $this->conn = $this->createMock(mysqli::class);

        // Inicializar o modelo com a conexão mockada
        $this->model = new AtualizarCadastroModel($this->conn);
    }
    // Teste para o método getUserById
    public function testGetUserById() {
        // Mock do PreparedStatement e ResultSet
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        // Configuração do retorno do ResultSet
        $resultMock->method('fetch_assoc')
            ->willReturn(['email' => 'teste@example.com', 'categoria' => 'admin']);
        $stmtMock->method('get_result')
            ->willReturn($resultMock);

        // Configuração do PreparedStatement para a conexão
        $this->conn->method('prepare')
            ->willReturn($stmtMock);

        // Executar o método e verificar o resultado
        $result = $this->model->getUserById(1);
        $this->assertEquals(['email' => 'teste@example.com', 'categoria' => 'admin'], $result);
    }

    // Teste para o método updateUserCategory
    public function testUpdateUserCategory() {
        // Mock do PreparedStatement
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $stmtMock->method('execute')->willReturn(true);

        // Configuração do PreparedStatement para a conexão
        $this->conn->method('prepare')
            ->willReturn($stmtMock);

        // Executar o método e verificar o resultado
        $result = $this->model->updateUserCategory(1, 'novoemail@example.com', 'user');
        $this->assertTrue($result);
    }
}

