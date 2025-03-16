<?php
require_once '../config/config.php';
class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection(); 
    }
    public function getUserByEmail($email) {
        $result = mysqli_query($this->db, "SELECT * FROM user WHERE email = '$email'");
        return mysqli_fetch_assoc($result);
    }

    public function registerUser($first_name, $last_name, $email, $password) {
        $sql = "INSERT INTO user (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";
        
        if ($this->db->query($sql)) {
            return true;
        } else {
            return "Erreur : " . $this->db->error;
        }
    }
}
?>
