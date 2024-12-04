<?php

// Executar teste phpunit
// // ./vendor/bin/phpunit tests/FaturamentoModelTest.php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../model/faturamento.php';

class FaturamentoModelTest extends TestCase {
    private $dbMock;
    private $faturamentoModel;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(mysqli::class);
        $this->faturamentoModel = new FaturamentoModel($this->dbMock);
    }

    public function testGetTotalVendido() {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        $this->dbMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($resultMock);
        $resultMock->method('fetch_assoc')->willReturn(['total_vendido' => 100.0]);

        $totalVendido = $this->faturamentoModel->getTotalVendido(1);
        $this->assertEquals(100.0, $totalVendido);
    }

    public function testGetTotalProdutosVendidos() {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        $this->dbMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($resultMock);
        $resultMock->method('fetch_assoc')->willReturn(['total_produtos_vendidos' => 50]);

        $totalProdutosVendidos = $this->faturamentoModel->getTotalProdutosVendidos(1);
        $this->assertEquals(50, $totalProdutosVendidos);
    }

    public function testGetTopProdutosVendidos() {
        $stmtMock = $this->createMock(mysqli_stmt::class);
        $resultMock = $this->createMock(mysqli_result::class);

        $this->dbMock->method('prepare')->willReturn($stmtMock);
        $stmtMock->method('bind_param')->willReturn(true);
        $stmtMock->method('execute')->willReturn(true);
        $stmtMock->method('get_result')->willReturn($resultMock);

        $resultMock->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['nome' => 'Produto 1', 'total_vendas' => 20],
            ['nome' => 'Produto 2', 'total_vendas' => 15],
            null
        );

        $topProdutosVendidos = $this->faturamentoModel->getTopProdutosVendidos(1);
        $this->assertEquals(
            [['nome' => 'Produto 1', 'total_vendas' => 20], ['nome' => 'Produto 2', 'total_vendas' => 15]],
            $topProdutosVendidos
        );
    }
}
