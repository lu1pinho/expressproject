<?php
use PHPUnit\Framework\TestCase;
//comando para o teste ./vendor/bin/phpunit --bootstrap vendor/autoload.php tests/FinalizarCompraTest.php


// Inclua o caminho correto para o arquivo que contém a classe EnderecoModel
require_once 'C:/xampp/htdocs/expressproject/model/finalizar_compra.php';

class FinalizarCompraTest extends TestCase
{
    private $conn;
    private $enderecoModel;

    protected function setUp(): void
    {
        $this->conn = $this->createMock(mysqli::class);
        $this->enderecoModel = new EnderecoModel($this->conn);
    }

    public function testBuscarEnderecoPorUsuario()
    {
        $stmt = $this->createMock(mysqli_stmt::class);
        $result = $this->createMock(mysqli_result::class);
        $expectedData = [
            'endereco' => 'Rua Exemplo',
            'bairro' => 'Bairro Exemplo',
            'complemento' => 'Complemento Exemplo',
            'numero' => '123',
            'cep' => '12345678',
            'cidade' => 'Cidade Exemplo',
            'estado' => 'Estado Exemplo'
        ];

        $result->expects($this->once())
               ->method('fetch_assoc')
               ->willReturn($expectedData);

        $stmt->expects($this->once())
             ->method('bind_param')
             ->with($this->equalTo("i"), $this->equalTo(1));
             
        $stmt->expects($this->once())
             ->method('execute');
        
        $stmt->expects($this->once())
             ->method('get_result')
             ->willReturn($result);
        
        $stmt->expects($this->once())
             ->method('close');

        $this->conn->expects($this->once())
                   ->method('prepare')
                   ->with($this->equalTo("SELECT endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?"))
                   ->willReturn($stmt);

        $endereco = $this->enderecoModel->buscarEnderecoPorUsuario(1);
        $this->assertEquals($expectedData, $endereco);
    }

    public function testBuscarProdutosCarrinho()
    {
        $stmt = $this->createMock(mysqli_stmt::class);
        $result = $this->createMock(mysqli_result::class);
        $produtoData = [
            'produto_nome' => 'Produto Exemplo',
            'url_img' => 'exemplo.jpg',
            'preco' => 50,
            'preco_com_desconto' => 45,
            'quantidade' => 2
        ];

        $result->expects($this->any())
               ->method('fetch_assoc')
               ->willReturnOnConsecutiveCalls($produtoData, false);

        $stmt->expects($this->once())
             ->method('bind_param')
             ->with($this->equalTo("i"), $this->equalTo(1));

        $stmt->expects($this->once())
             ->method('execute');

        $stmt->expects($this->once())
             ->method('get_result')
             ->willReturn($result);
        
        $stmt->expects($this->once())
             ->method('close');

        $this->conn->expects($this->once())
                   ->method('prepare')
                   ->with($this->equalTo("SELECT produto_nome, url_img, preco, preco_com_desconto, quantidade FROM carrinho WHERE id_user = ?"))
                   ->willReturn($stmt);

        $produtos = $this->enderecoModel->buscarProdutosCarrinho(1);
        $this->assertInstanceOf(mysqli_result::class, $produtos);
    }

    public function testExcluirProdutosCarrinho()
    {
        $stmt = $this->createMock(mysqli_stmt::class);

        $stmt->expects($this->once())
             ->method('bind_param')
             ->with($this->equalTo("i"), $this->equalTo(1));

        $stmt->expects($this->once())
             ->method('execute')
             ->willReturn(true);

        $this->conn->expects($this->once())
                   ->method('prepare')
                   ->with($this->equalTo("DELETE FROM carrinho WHERE id_user = ?"))
                   ->willReturn($stmt);

        $result = $this->enderecoModel->excluirProdutosCarrinho(1);
        $this->assertTrue($result);
    }
}

?>
