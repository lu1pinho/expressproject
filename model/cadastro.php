<?php
class UserModel {

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($name, $phone, $category, $email, $password) {
        $sql_insert = "INSERT INTO users (nome, telefone, categoria, email, senha) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql_insert);
        $stmt->bind_param('sssss', $name, $phone, $category, $email, $password);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkEmailExists($email) {
        $sql_check_email = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql_check_email);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->num_rows > 0;
    }
}
?>