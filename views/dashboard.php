<?php
include '../models/usermodels.php';
include '../controllers/admincontroller.php';

// Initialiser le contrôleur Admin
$adminController = new AdminController();
$clubsData = $adminController->getClubsData();
// Récupérer les statistiques et les données
$allClubs = $adminController->viewClubs();
$applications = $adminController->viewApplications();
$alluser = $adminController->getAllUsers();
$membresParClub = $adminController->viewMembersByClub();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
<div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">Espace Administrateur</h1>
            <div class="wave-effect"></div>
        </header>
    </div>
        <style>
        .animated-header {
            height: 100px;
            background: #dc3545;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .wave-effect {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1000 100" xmlns="http://www.w3.org/2000/svg"><path fill="%23ffffff" opacity="0.25" d="M 0 50 Q 250 0 500 50 T 1000 50 L 1000 100 L 0 100 Z"></path></svg>');
            animation: wave 10s infinite linear;
        }
    </style>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="adminpage.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="membre.php">Gérer les membres</a></li>
                <li class="nav-item"><a class="nav-link" href="paremétre.php">Paramètres</a></li>
            </ul>
            <form class="d-flex ms-auto">
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </form>
        </div>
    </nav>


    <div class="container mt-4">
    <h3>Liste des Clubs</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du Club</th>
                <th>Date de Création</th>
                <th>Nombre de Membres</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clubsData as $club): ?>
                <tr>
                    <td><?= htmlspecialchars($club['club_id']) ?></td>
                    <td><?= htmlspecialchars($club['club_name']) ?></td>
                    <td><?= htmlspecialchars($club['date_de_creation']) ?></td>
                    <td><?= htmlspecialchars($club['total_membres']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
