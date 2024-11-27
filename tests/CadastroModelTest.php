<?php

use PHPUnit\Framework\TestCase;
use Model\CadastroModel;

class CadastroModelTest extends TestCase
{
    public function testCheckEmailExistsTrue()
    {
        // Mock para mysqli_result
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('num_rows')->willReturn(1);

        // Mock para mysqli_stmt
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('get_result')->willReturn($mockResult);

        // Mock para mysqli
        $mockConn = $this->createMock(mysqli::class);
        $mockConn->method('prepare')->willReturn($mockStmt);

        // Instancia o modelo
        $userModel = new CadastroModel($mockConn);

        // Executa o teste
        $result = $userModel->checkEmailExists('test@example.com');

        // Verifica se o resultado é verdadeiro
        $this->assertTrue($result);
    }

    public function testCheckEmailExistsFalse()
    {
        // Mock para mysqli_result
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('num_rows')->willReturn(0);

        // Mock para mysqli_stmt
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $mockStmt->method('execute')->willReturn(true);
        $mockStmt->method('get_result')->willReturn($mockResult);

        // Mock para mysqli
        $mockConn = $this->createMock(mysqli::class);
        $mockConn->method('prepare')->willReturn($mockStmt);

        // Instancia o modelo
        $userModel = new CadastroModel($mockConn);

        // Executa o teste
        $result = $userModel->checkEmailExists('nonexistent@example.com');

        // Verifica se o resultado é falso
        $this->assertFalse($result);
    }
}
