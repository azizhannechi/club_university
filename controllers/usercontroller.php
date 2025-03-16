<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/models/usermodels.php';


class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function register($first_name, $last_name, $email, $password) {
        return $this->userModel->registerUser($first_name, $last_name, $email, $password);
    }
    public function login($email, $password) {
        $user = $this->userModel->getUserByEmail($email);

        if ($user && $user['password'] === $password) {
            session_start();
            return $user['role'];
        }

        return false; // Identifiants incorrects
    }
}
?>