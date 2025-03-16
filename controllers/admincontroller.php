<?php
include '../models/usermodels.php';
include '../config/config.php';
session_start();

class AdminController {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
    public function getAllUsers() {
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Supprimer un utilisateur par ID
    public function deleteUser($userId) {
        $sql = "DELETE FROM user WHERE id = $userId";
        return mysqli_query($this->db, $sql);
    }


    // Afficher la liste des clubs
    public function viewClubs() {
        $sql = "SELECT * FROM clubs";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Afficher les demandes d'adhésion
    public function viewApplications() {
        $sql = "SELECT * FROM membre";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Générer des statistiques
    public function generateStatistics() {
        $sql = "SELECT club_id, COUNT(*) as total_members FROM application GROUP BY club_id";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Supprimer un club
    public function deleteClub($clubId) {
        $sql = "DELETE FROM clubs WHERE id = '$clubId'";
        return mysqli_query($this->db, $sql);
    }
}