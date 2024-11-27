<?php 
use PHPUnit\Framework\TestCase;
include '../model/ProdutoModel.php';

class ProdutoModelTest extends TestCase {
  private $conn;
  private $produtoModel;

  protected function setUp(): void {
      // Mock da conexão com o banco de dados
      $this->conn = $this->createMock(mysqli::class);

      // Inicializa o modelo com a conexão mockada
      $this->produtoModel = new ProdutoModel($this->conn);
  }

  // Teste para o método getOfertasDoDia
  public function testGetOfertasDoDia() {
      // Mock do PreparedStatement e ResultSet
      $stmtMock = $this->createMock(mysqli_stmt::class);
      $resultMock = $this->createMock(mysqli_result::class);

      // Configuração do retorno de dados mockados
      $resultMock->method('fetch_assoc')
          ->willReturnOnConsecutiveCalls(
              ['id' => 1, 'nome' => 'Produto 1', 'oferta_do_dia' => 1],
              null
          );
      $stmtMock->method('get_result')->willReturn($resultMock);

      // Configuração do PreparedStatement para a conexão
      $this->conn->method('prepare')->willReturn($stmtMock);

      // Executa o método
      $result = $this->produtoModel->getOfertasDoDia(6);

      // Valida se o método foi chamado corretamente
      $this->assertInstanceOf(mysqli_result::class, $result);
  }

  // Teste para o método getMaisVendidos
  public function testGetMaisVendidos() {
      // Mock do PreparedStatement e ResultSet
      $stmtMock = $this->createMock(mysqli_stmt::class);
      $resultMock = $this->createMock(mysqli_result::class);

      // Configuração do retorno de dados mockados
      $resultMock->method('fetch_assoc')
          ->willReturnOnConsecutiveCalls(
              ['id' => 1, 'nome' => 'Produto 1', 'n_vendas' => 100],
              null
          );
      $stmtMock->method('get_result')->willReturn($resultMock);

      // Configuração do PreparedStatement para a conexão
      $this->conn->method('prepare')->willReturn($stmtMock);

      // Executa o método
      $result = $this->produtoModel->getMaisVendidos(6);

      // Valida se o método foi chamado corretamente
      $this->assertInstanceOf(mysqli_result::class, $result);
  }
}
?>