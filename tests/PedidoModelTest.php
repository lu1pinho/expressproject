<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../model/pagamento.php';


class PedidoModelTest extends TestCase
{
    private $mockConn;
    private $pedidoModel;

    protected function setUp(): void
    {
        // Mock da conexão com o banco de dados
        $this->mockConn = $this->createMock(mysqli::class);
        $this->pedidoModel = new PedidoModel($this->mockConn);
    }

    public function testBuscarCepUsuario()
    {
        $idUsuario = 1;
        $expectedCep = ['cep' => '12345678'];

        // Mock para o método prepare
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        $this->mockConn->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('get_result')->willReturn($resultMock);
        $resultMock->method('fetch_assoc')->willReturn($expectedCep);

        $result = $this->pedidoModel->buscarCepUsuario($idUsuario);
        $this->assertEquals($expectedCep, $result);
    }

    public function testBuscarProdutosCarrinho()
    {
        $idUsuario = 1;
        $expectedProdutos = [
            ['produto_nome' => 'Produto 1', 'url_img' => 'url1.jpg', 'quantidade' => 2, 'preco' => 10.0, 'preco_com_desconto' => 8.0],
            ['produto_nome' => 'Produto 2', 'url_img' => 'url2.jpg', 'quantidade' => 1, 'preco' => 20.0, 'preco_com_desconto' => null],
        ];

        // Mock para o método prepare
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        $this->mockConn->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('get_result')->willReturn($resultMock);
        $resultMock->method('fetch_all')->willReturn($expectedProdutos);

        $produtos = $this->pedidoModel->buscarProdutosCarrinho($idUsuario);
        $this->assertEquals($expectedProdutos, $produtos);
    }

    public function testInserirProdutosComprados()
    {
        $idUsuario = 1;
        $produtoNome = 'Produto Teste';
        $quantidade = 1;
        $preco = 100.0;
        $urlImg = 'url_teste.jpg';

        // Mock para o método prepare
        $stmtMock = $this->createMock(mysqli_stmt::class);

        $this->mockConn->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);

        $this->pedidoModel->inserirProdutosComprados($idUsuario, $produtoNome, $quantidade, $preco, $urlImg);
        $this->assertTrue(true); // Verifica que não houve exceção
    }

    public function testExcluirProdutosCarrinho()
    {
        $idUsuario = 1;

        // Mock para o método prepare
        $stmtMock = $this->createMock(mysqli_stmt::class);

        $this->mockConn->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);

        $this->pedidoModel->excluirProdutosCarrinho($idUsuario);
        $this->assertTrue(true); // Verifica que não houve exceção
    }
}
