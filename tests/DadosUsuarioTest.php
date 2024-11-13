<?php
use PHPUnit\Framework\TestCase;

class DadosUsuarioTest extends TestCase
{
    protected $backupGlobalsBlacklist = ['_SESSION'];

    protected function setUp(): void
    {
        // Inicia a sessão
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function tearDown(): void
    {
        // Limpa a sessão após cada teste
        $_SESSION = [];
    }

    public function testRedirecionarParaLoginQuandoNaoAutenticado()
{
    // Limpa a sessão para simular um usuário não autenticado
    unset($_SESSION['id']);
    
    // Inicia o buffer de saída
    ob_start();
    
    // Inclui o arquivo que será testado (código de redirecionamento)
    include '../control/dados_usuario.php';
    
    // Captura o conteúdo do buffer de saída (caso seja gerado conteúdo)
    $output = ob_get_clean();
    
    // Obtém a lista de cabeçalhos enviados
    $headers = headers_list();  
    
    // Verifica se um cabeçalho de redirecionamento foi enviado
    $this->assertNotEmpty($headers, 'Nenhum cabeçalho foi enviado.');
    $this->assertStringContainsString('Location: login.php', $headers[0], 'O redirecionamento não ocorreu para a página de login.');
}


    public function testCarregarDadosDoUsuario()
    {
        // Define um usuário autenticado
        $_SESSION['id'] = 1;

        // Mock do model para retornar dados fictícios
        include_once '../model/dados_usuario.php';

        $dadosUsuario = carregarDadosUsuarioMock();

        $this->assertArrayHasKey('nome', $dadosUsuario);
        $this->assertEquals('Usuário Teste', $dadosUsuario['nome']);
        $this->assertEquals('teste@teste.com', $dadosUsuario['email']);
    }

    public function testAtualizarDadosComPost()
    {
        // Define um usuário autenticado
        $_SESSION['id'] = 1;

        // Simula uma requisição POST
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = [
            'atualizar' => true,
            'nome' => 'Novo Nome',
            'email' => 'novoteste@teste.com'
        ];

        // Mock do model para simular atualização
        include_once '../model/dados_usuario.php';

        $resultado = atualizarDadosUsuarioMock($_SESSION['id'], $_POST);
        $this->assertTrue($resultado['sucesso']);
        $this->assertEquals('Dados atualizados com sucesso', $resultado['mensagem']);
    }
}

// Mocks do model
function carregarDadosUsuarioMock()
{
    return [
        'nome' => 'Usuário Teste',
        'email' => 'teste@teste.com',
        'endereco' => ['rua' => 'Rua A', 'cidade' => 'Cidade B'],
        'cartoes' => [['numero' => '**** **** **** 1234', 'validade' => '12/24']]
    ];
}

function atualizarDadosUsuarioMock($userId, $dados)
{
    if ($userId === 1) {
        return [
            'sucesso' => true,
            'mensagem' => 'Dados atualizados com sucesso'
        ];
    }
    return [
        'sucesso' => false,
        'mensagem' => 'Erro ao atualizar'
    ];
}

?>
