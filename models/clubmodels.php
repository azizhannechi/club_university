<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ .'/../controllers/admincontroller.php';

class ClubModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    // Fonction pour récupérer tous les clubs
    public function getAllClubs() {
        $sql = "SELECT * FROM clubs";
        $result = $this->db->query($sql);

        $clubs = [];
        while ($row = $result->fetch_assoc()) {
            $clubs[] = $row;
        }
        return $clubs;
    }

    // Fonction pour ajouter un nouveau club
    public function addClub($name, $creation_date, $social_links) {
        $sql = "INSERT INTO clubs (club_name, date_de_creation, liens_sociaux) 
                VALUES ('$name', '$creation_date', '$social_links')";
        return $this->db->query($sql);
    }
}
?>
