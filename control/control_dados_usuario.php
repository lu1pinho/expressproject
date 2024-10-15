<?php
session_start();
require_once '../model/dados_usuario.php';
include 'C:/xampp/htdocs/expressproject/src/settings/connection.php';

class UserController
{
    private $model;

    public function __construct($dbConnection)
    {
        $this->model = new User($dbConnection);
    }

    public function getUserDetails($userId)
    {
        $userData = $this->model->getUserData($userId);
        $userAddress = $this->model->getUserAddress($userId);
        $userCard = $this->model->getUserCard($userId);
        return [
            'userData' => $userData,
            'userAddress' => $userAddress,
            'userCard' => $userCard
        ];
    }

    public function updateUser($postData)
    {
        // Aqui você pode validar os dados e então chamar os métodos de atualização
        $this->model->updateUser($postData);
        $this->model->updateUserAddress($postData);
        $this->model->updateUserCard($postData);
    }
}

if (!isset($_SESSION['id'])) {
    header('Location: control_login.php');
    exit();
}

$userController = new UserController($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->updateUser($_POST);
    header('Location: control_dados_usuario.php');
} else {
    $userData = $userController->getUserDetails($_SESSION['id']);
    include '../view/dados-usuario.php';
}
