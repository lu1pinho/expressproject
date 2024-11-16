<?php

use PHPUnit\Framework\TestCase;
use Model\PedidosRealizadosModel; // Alinhar com o modelo

class PedidosRealizadosModelTest extends TestCase {
    private $mockConnection;
    private $mockModel;

    protected function setUp(): void {
        $this->mockConnection = $this->createMock(mysqli::class);
        $this->mockModel = new PedidosRealizadosModel($this->mockConnection); // Usar o nome correto
    }

    public function testGetProductsInCartReturnsExpectedData() {
        $mockStmt = $this->createMock(mysqli_stmt::class);
        $this->mockConnection
            ->method('prepare')
            ->with("SELECT produto_nome, url_img, preco, data_compra, quantidade FROM produtos_comprados WHERE id_user = ?")
            ->willReturn($mockStmt);

        $mockStmt->method('bind_param')->with('i', $this->anything());
        $mockStmt->method('execute')->willReturn(true);

        $mockResult = $this->createMock(mysqli_result::class);
        $mockStmt->method('get_result')->willReturn($mockResult);

        $mockResult->method('fetch_all')->willReturn([
            ['produto_nome' => 'Produto 1', 'url_img' => 'img1.jpg', 'preco' => 100, 'data_compra' => '2024-11-01', 'quantidade' => 2],
            ['produto_nome' => 'Produto 2', 'url_img' => 'img2.jpg', 'preco' => 200, 'data_compra' => '2024-11-02', 'quantidade' => 1],
        ]);

        $result = $this->mockModel->getProductsInCart(1);

        $this->assertIsObject($result); // Verificar que o resultado é um objeto válido
        $this->assertEquals(2, count($result->fetch_all(MYSQLI_ASSOC))); // Verificar o número de produtos
    }
}
