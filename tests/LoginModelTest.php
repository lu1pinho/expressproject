<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../model/login.php';

class LoginModelTest extends TestCase {
    private $model;
    private $conn;

    protected function setUp(): void {
        // Mock da conexão com o banco de dados
        $this->conn = $this->createMock(mysqli::class);

        // Inicializar o modelo com a conexão mockada
        $this->model = new UserModel($this->conn);
    }

    // Teste para o método findUserByEmailAndPassword
    public function testFindUserByEmailAndPassword() {
        // Mock do ResultSet
        $resultMock = $this->createMock(mysqli_result::class);

        // Configuração do retorno do ResultSet
        $resultMock->method('fetch_assoc')
            ->willReturn(['id' => 1, 'nome' => 'Usuário Teste', 'email' => 'teste@example.com']);

        // Configuração do método query para retornar o ResultSet mockado
        $this->conn->method('query')
            ->willReturn($resultMock);

        // Executar o método e verificar o resultado
        $result = $this->model->findUserByEmailAndPassword('teste@example.com', 'senha123');
        $this->assertEquals(['id' => 1, 'nome' => 'Usuário Teste', 'email' => 'teste@example.com'], $result);
    }

    // Teste para credenciais inválidas
    public function testFindUserByEmailAndPasswordInvalid() {
        // Configurando o método query para retornar falso (nenhum resultado encontrado)
        $this->conn->method('query')
            ->willReturn(false);

        // Executar o método e verificar o resultado
        $result = $this->model->findUserByEmailAndPassword('invalido@example.com', 'senhaerrada');
        $this->assertNull($result);
    }
}
