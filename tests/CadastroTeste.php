<?php

use PHPUnit\Framework\TestCase;

class CadastroTeste extends TestCase
{
    public function testCheckEmailExistsTrue()
    {
        // Cria um mock para o resultado da consulta
        $mockResult = $this->createMock(mysqli_result::class);
        
        // Configura o método num_rows para retornar 1 (indicando que o email existe)
        $mockResult->method('num_rows')->willReturn(1);
        
        // Cria o mock para a conexão MySQLi
        $mockConn = $this->createMock(mysqli::class);
        
        // Configura o método get_result() para retornar o mock de resultado
        $mockConn->method('prepare')->willReturnSelf();
        $mockConn->method('bind_param')->willReturn(true);
        $mockConn->method('execute')->willReturn(true);
        $mockConn->method('get_result')->willReturn($mockResult);
        
        // Cria a instância do modelo e passa a conexão mockada
        $userModel = new UserModel($mockConn);
        
        // Executa o teste
        $result = $userModel->checkEmailExists('test@example.com');
        
        // Verifica se o resultado é verdadeiro (email existe)
        $this->assertTrue($result);
    }

    public function testCheckEmailExistsFalse()
    {
        // Cria um mock para o resultado da consulta
        $mockResult = $this->createMock(mysqli_result::class);
        
        // Configura o método num_rows para retornar 0 (indicando que o email não existe)
       $mockResult->method('num_rows')->willReturn(0);
        
        // Cria o mock para a conexão MySQLi
        $mockConn = $this->createMock(mysqli::class);
        
        // Configura o método get_result() para retornar o mock de resultado
        $mockConn->method('prepare')->willReturnSelf();
        $mockConn->method('bind_param')->willReturn(true);
        $mockConn->method('execute')->willReturn(true);
        $mockConn->method('get_result')->willReturn($mockResult);
        
        // Cria a instância do modelo e passa a conexão mockada
        $userModel = new UserModel($mockConn);
        
        // Executa o teste
        $result = $userModel->checkEmailExists('test@example.com');
        
        // Verifica se o resultado é falso (email não existe)
        $this->assertFalse($result);
    }
}

?>
