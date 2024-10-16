<?php
class infPedido_finalizar_pedido
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function calcularFrete($cep)
    {
        // Remover caracteres não numéricos do CEP
        $cep = preg_replace('/\D/', '', $cep);

        // Verifica se a conexão está ativa
        if (!$this->conn) {
            die("Erro de conexão: " . mysqli_connect_error());
        }

        // Consulta ao banco de dados para o valor do frete
        $sql = "SELECT valor FROM frete WHERE cep = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar a consulta: " . $this->conn->error);
        }

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
}
?>
