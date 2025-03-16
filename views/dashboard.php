<?php
require_once '../controllers/admincontroller.php';

// Initialiser le contrôleur Admin
$adminController = new AdminController();

// Récupérer les statistiques
$clubStats = $adminController->generateStatistics();
$allClubs = $adminController->viewClubs();
$applications = $adminController->viewApplications();
$alluser = $adminController->getAllUsers()
?>
   <!DOCTYPE html>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
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
    <body>
    <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">Espace Administrateur</h1>
            <div class="wave-effect"></div>
        </header>

        <!-- Section statistiques -->
        <h3>Statistiques des clubs</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID du Club</th>
                    <th>Nombre de Membres</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clubStats as $stat): ?>
                    <tr>
                        <td><?= $stat['club_id'] ?></td>
                        <td><?= $stat['total_members'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Liste des clubs -->
        <h3>Liste des Clubs</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Club</th>
                    <th>Date de Création</th>
                    <th>Réseaux Sociaux</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allClubs as $club): ?>
                    <tr>
                        <td><?= $club['id'] ?></td>
                        <td><?= $club['name'] ?></td>
                        <td><?= $club['creation_date'] ?></td>
                        <td><?= $club['social_links'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Liste des demandes d'adhésion -->
        <h3>Demandes d'Adhésion</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID de la Demande</th>
                    <th>ID Étudiant</th>
                    <th>ID du Club</th>
                    <th>CV</th>
                    <th>Date de Demande</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?= $app['id'] ?></td>
                        <td><?= $app['student_id'] ?></td>
                        <td><?= $app['club_id'] ?></td>
                        <td><a href="uploads/<?= $app['cv'] ?>" target="_blank">Voir CV</a></td>
                        <td><?= $app['application_date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
</html>