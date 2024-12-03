<?php
class UserModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function findUserByEmailAndPassword($email, $password) {
        $sql = "SELECT * FROM users WHERE email = ? AND senha = SHA2(?, 256)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('ss', $email, $password);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        return null;
    }
}

?>
