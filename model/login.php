<?php
class UserModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function findUserByEmailAndPassword($email, $password) {
        $email = $this->conn->real_escape_string($email);
        $password = $this->conn->real_escape_string($password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND senha = '$password'";
        $query = $this->conn->query($sql);

        if ($query) {
            return $query->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
