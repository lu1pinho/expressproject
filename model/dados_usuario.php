<?php
class User
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    public function getUserData($userId)
    {
        $sql = "SELECT id, nome, email, genero, cpf, telefone, dt_nascimento FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserAddress($userId)
    {
        $sql = "SELECT id_end, endereco, bairro, complemento, numero, cep, cidade, estado FROM enderecos WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUserCard($userId)
    {
        $sql = "SELECT id_cartao, nome_cartao, apelido, numero_cartao, dt_expedicao, cvv, categoria_cartao FROM cartoes WHERE id_user= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateUser($data)
    {
        $sql = "UPDATE users SET nome = ?, email = ?, genero = ?, cpf = ?, telefone = ?, dt_nascimento = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $data['nome'], $data['email'], $data['genero'], $data['cpf'], $data['telefone'], $data['dt_nascimento'], $data['id']);
        return $stmt->execute();
    }

    public function updateUserAddress($data)
    {
        $sql = "UPDATE enderecos SET endereco = ?, bairro = ?, complemento = ?, numero = ?, cep = ?, cidade = ?, estado = ? WHERE id_end = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssisssi", $data['endereco'], $data['bairro'], $data['complemento'], $data['numero'], $data['cep'], $data['cidade'], $data['estado'], $data['id_end']);
        return $stmt->execute();
    }

    public function updateUserCard($data)
    {
        $sql = "UPDATE cartoes SET nome_cartao = ?, apelido = ?, numero_cartao = ?, dt_expedicao = ?, cvv = ?, categoria_cartao = ? WHERE id_cartao = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssisi", $data['nome_cartao'], $data['apelido'], $data['numero_cartao'], $data['dt_expedicao'], $data['cvv'], $data['categoria_cartao'], $data['id_cartao']);
        return $stmt->execute();
    }
}
