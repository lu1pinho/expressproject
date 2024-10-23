<?php 
class AtualizarCadastroModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para buscar os dados do usuário atual
    public function getUserById($userId) {
        $sql = "SELECT email, categoria FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);  // Preparando a consulta
        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);  // Bind do parâmetro
        $stmt->execute();  // Executando a consulta
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Método para atualizar a categoria e o email do usuário
    public function updateUserCategory($userId, $email, $categoria) {
        $sql = "UPDATE users SET email = ?, categoria = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);  // Preparando a consulta
        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conn->error);
        }
        $stmt->bind_param("ssi", $email, $categoria, $userId);  // Bind dos parâmetros

        if ($stmt->execute()) {  // Executando a consulta
            return true;
        } else {
            echo "Erro ao atualizar: " . $stmt->error;
            return false;
        }
    }
    
    // Método para verificar a senha do usuário pelo ID (sem criptografia)
    public function verifyPasswordById($userId, $senha) {
        // Busca a senha armazenada no banco de dados
        $sql = "SELECT senha FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);  // Preparando a consulta
        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conn->error);
        }
        $stmt->bind_param("i", $userId);  // Bind do parâmetro
        $stmt->execute();  // Executando a consulta
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Comparação direta sem criptografia
            return $senha === $user['senha'];
        }

        return false;
    }
}
?>