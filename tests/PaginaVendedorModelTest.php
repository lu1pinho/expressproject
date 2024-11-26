<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Model\PaginaVendedorModel; // Certifique-se de que o namespace está correto

class PaginaVendedorModelTest extends TestCase
{
    /** @var MockObject */
    private $dbMock;

    /** @var PaginaVendedorModel */
    private $model;

    protected function setUp(): void
    {
        // Cria um mock da classe de conexão com o banco de dados
        $this->dbMock = $this->createMock(mysqli::class);
        
        // Instancia o model, passando o mock como dependência
        $this->model = new PaginaVendedorModel();
    }

    public function testGetCategorias(): void
    {
        // Configura o mock para retornar um resultado específico
        $resultMock = $this->createMock(mysqli_result::class);
        $this->dbMock->method('query')->willReturn($resultMock);

        // Configura o mock de resultados para retornar linhas simuladas
        $resultMock->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['categoria' => 'Eletrônicos'],
            ['categoria' => 'Roupas'],
            null
        );

        $result = $this->model->getCategorias($this->dbMock);

        // Verifica se os resultados foram retornados corretamente
        $this->assertInstanceOf(mysqli_result::class, $result);
    }

    public function testFormatarNomeCategoria(): void
    {
        $categoria = 'eletrônicos_de_consumo';
        $resultadoEsperado = 'Eletrônicos de Consumo';
        
        $resultado = $this->model->formatarNomeCategoria($categoria);
        
        // Verifica se a formatação está correta
        $this->assertEquals($resultadoEsperado, $resultado);
    }

    public function testBuildQuery(): void
    {
        $categoria = 'Eletrônicos';
        $preco_min = 100;
        $preco_max = 1000;
        $ofertas = true;
        $descontos = false;
        $frete_gratis = true;
        $go_express = false;
        $termo_busca = 'celular';

        $resultado = $this->model->buildQuery($categoria, $preco_min, $preco_max, $ofertas, $descontos, $frete_gratis, $go_express, $termo_busca);

        // Verifica se a query e os parâmetros estão corretos
        $this->assertIsArray($resultado);
        $this->assertCount(3, $resultado); // Verifica que tem três elementos no array
    }
}
