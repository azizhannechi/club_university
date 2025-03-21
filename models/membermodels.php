<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controllers/membrecontroller.php';

class MemberModel {
    private $db;

    public function __construct() {
        $this->db = Database ::getConnection();
        }

    public function getMembresParClub() {
        $query = "SELECT membres.id, membres.prenom, membres.nom, membres.email, clubs.club_name 
                  FROM membres 
                  LEFT JOIN clubs ON membres.club_id = clubs.club_id";

        $result = $this->db->query($query);
        if (!$result) {
            die("Erreur SQL : " . $this->db->error);
        }

        $membres_par_club = [];
        while ($row = $result->fetch_assoc()) {
            $club = $row["club_name"] ?? "Aucun club";
            $membres_par_club[$club][] = $row;
        }

        return $membres_par_club;
    }
}
?>
