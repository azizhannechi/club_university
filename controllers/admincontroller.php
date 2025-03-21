<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/usermodels.php';
require_once __DIR__ .'/../models/clubmodels.php';

class AdminController {
    private $db;
    private $add;
    private $viewclub;

    public function __construct() {
        $this->db = Database::getConnection();
        $this->add= new ClubModel();
        $this->viewclub = new ClubModel();
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

   
    public function updateUser($id, $username, $email, $role) {
        $username = mysqli_query($this->db, $username);
        $email = mysqli_query($this->db, $email);
        $role = mysqli_query($this->db, $role);

        $sql = "UPDATE users SET first_name = '$username', email = '$email', role = '$role' WHERE id = $id";
        return mysqli_query($this->db, $sql);
    }


    // Afficher la liste des clubs
    public function viewClubs() {
        return $this->viewclub->getAllClubs();
    }

    // Afficher les demandes d'adhésion
    public function viewApplications() {
        $sql = "SELECT * FROM membres";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Générer des statistiques
    public function generateStatistics() {
        $sql = "SELECT club_id, COUNT(*) as total_members FROM membres GROUP BY club_id";
        $result = mysqli_query($this->db, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Supprimer un club
    public function deleteClub($clubId) {
        $sql = "DELETE FROM clubs WHERE id = '$clubId'";
        return mysqli_query($this->db, $sql);
    }
    public function viewMembersByClub() {
        $sql = "SELECT membres.id, membres.prenom, membres.nom, membres.email, clubs.club_name 
                FROM membres 
                LEFT JOIN clubs ON membres.club_id = clubs.club_id";
    
        $result = $this->db->query($sql);
    
        // Vérifier si la requête a échoué
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
    public function deleteMemeber($Id) {
        $sql = "DELETE FROM members WHERE id = '$Id'";
        return mysqli_query($this->db, $sql);
}
public function ajoutClub($name, $creation_date, $social_links) {
    return $this->add->addClub($name, $creation_date, $social_links);
}
public function getClubsData() {
    $sql = "SELECT clubs.club_id, clubs.club_name, clubs.date_de_creation, COUNT(membres.id) AS total_membres 
        FROM clubs 
        LEFT JOIN membres ON clubs.club_id = membres.club_id 
        GROUP BY clubs.club_id, clubs.club_name, clubs.date_de_creation";
    $result = $this->db->query($sql);
    if (!$result) {
        die("Erreur SQL : " . $this->db->error);
    }
    $clubs = [];
    while ($row = $result->fetch_assoc()) {
        $clubs[] = $row;
    }

    return $clubs;

    }
}
