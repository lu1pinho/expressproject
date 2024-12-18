<?php
class PedidoModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function buscarCepUsuario($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT cep FROM enderecos WHERE id_user = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function calcularFrete($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (!$this->conn) {
            die("Erro de conexão: " . mysqli_connect_error());
        }

        $sql = "SELECT valor FROM frete WHERE cep = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $cep);
        $stmt->execute();
        $stmt->bind_result($valorFrete);

        if ($stmt->fetch()) {
            $stmt->close();
            return floatval($valorFrete);
        } else {
            $stmt->close();
            return 0;
        }
    }

    public function buscarProdutosCarrinho($id_usuario)
    {
        $stmt = $this->conn->prepare("SELECT produto_nome, url_img, quantidade, preco, preco_com_desconto 
        FROM carrinho 
        WHERE id_user = ?");

        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function buscarCartoesUsuario($id_usuario)
    {
        $sql = "SELECT * FROM cartoes WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarIdProdutoPorNome($produto_nome)
    {
        $stmt = $this->conn->prepare("SELECT id FROM produtos WHERE nome = ?");

        if (!$stmt) {
            die("Erro ao preparar a consulta SQL: " . $this->conn->error);
        }

        $stmt->bind_param("s", $produto_nome);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $produto = $result->fetch_assoc();
            return $produto['id'];
        } else {
            return null;
        }
    }

    public function gerarCodigo()
    {
        do {
            // Gera um código aleatório de 10 caracteres (alfanuméricos)
            $codigo = strtoupper(bin2hex(random_bytes(5)));

            // Verifica no banco de dados se o código já existe
            $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM produtos_comprados WHERE codigo = ?");
            $stmt->bind_param("s", $codigo);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
        } while ($result['total'] > 0); // Continua gerando até encontrar um código único

        return $codigo;
    }


    public function inserirProdutosComprados($id_usuario, $id_produto, $produto_nome, $quantidade, $preco, $url_img)
    {
        $produto_nome = $this->conn->real_escape_string($produto_nome);

        // Gera o código do pedido
        $codigo = $this->gerarCodigo();

        $sql_insert = "INSERT INTO produtos_comprados (id_user, id_produto, produto_nome, quantidade, preco, url_img, codigo, data_compra) 
                   VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt_insert = $this->conn->prepare($sql_insert);

        if (!$stmt_insert) {
            die("Erro ao preparar a consulta de inserção: " . $this->conn->error);
        }

        $stmt_insert->bind_param("iissdss", $id_usuario, $id_produto, $produto_nome, $quantidade, $preco, $url_img, $codigo);

        if (!$stmt_insert->execute()) {
            die("Erro ao inserir produto na tabela produtos_comprados: " . $stmt_insert->error);
        }

        $stmt_insert->close();
    }




    public function excluirProdutosCarrinho($id_usuario)
    {
        $sql_delete = "DELETE FROM carrinho WHERE id_user = ?";
        $stmt_delete = $this->conn->prepare($sql_delete);

        if (!$stmt_delete) {
            die("Erro ao preparar a consulta de exclusão: " . $this->conn->error);
        }

        $stmt_delete->bind_param("i", $id_usuario);

        if (!$stmt_delete->execute()) {
            die("Erro ao excluir produtos do carrinho: " . $stmt_delete->error);
        }

        $stmt_delete->close();
    }

    public function buscarVendedoresPorUsuario($id_usuario)
    {
        // Primeiro, buscamos os id_produto na tabela produtos_comprados
        $stmt = $this->conn->prepare("SELECT id_produto FROM produtos_comprados WHERE id_user = ?");
        if (!$stmt) {
            die("Erro ao preparar consulta para buscar produtos comprados: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $produtos = $result->fetch_all(MYSQLI_ASSOC);

        if (empty($produtos)) {
            return []; // Retorna vazio caso não existam produtos comprados
        }

        $vendedores = [];
        foreach ($produtos as $produto) {
            $id_produto = $produto['id_produto'];

            // Para cada id_produto, buscamos o vendedor_id na tabela produtos
            $stmt_vendedor = $this->conn->prepare("SELECT vendedor_id FROM produtos WHERE id = ?");
            if (!$stmt_vendedor) {
                die("Erro ao preparar consulta para buscar vendedor: " . $this->conn->error);
            }

            $stmt_vendedor->bind_param("i", $id_produto);
            $stmt_vendedor->execute();
            $result_vendedor = $stmt_vendedor->get_result();
            $vendedor = $result_vendedor->fetch_assoc();

            if ($vendedor) {
                $vendedores[] = $vendedor['vendedor_id'];
            }

            $stmt_vendedor->close();
        }

        return $vendedores; // Retorna todos os vendedor_id encontrados
    }

    public function buscarDadosVendedor($vendedor_id)
    {
        $sql = "SELECT nome, email, telefone FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar consulta para buscar dados do vendedor: " . $this->conn->error);
        }

        $stmt->bind_param("i", $vendedor_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Retorna os dados do vendedor, ou `null` se não encontrar
        return $result->fetch_assoc();
    }
}
