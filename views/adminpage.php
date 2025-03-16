<?php
include '../models/usermodels.php';
include '../controllers/admincontroller.php';

// Initialiser le contrôleur Admin
$adminController = new AdminController();

// Supprimer un utilisateur
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if ($adminController->deleteUser($delete_id)) {
        echo "<div class='alert alert-success'>Utilisateur supprimé avec succès.</div>";
    } else {
        echo "<div class='alert alert-danger'>Erreur lors de la suppression.</div>";
    }
}

// Récupérer tous les utilisateurs
$users = $adminController->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Administrateur</title>

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
</head>
<body>
    <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">Espace Administrateur</h1>
            <div class="wave-effect"></div>
        </header>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="adminpage.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Gérer les utilisateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="settings.html">Paramètres</a></li>
            </ul>
            <form class="d-flex ms-auto">
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </form>
        </div>
    </nav>

    <section class="container my-5 text-center">
        <h2>Panneau de contrôle</h2>
        <p>Gérez les utilisateurs, surveillez l'activité et ajustez les paramètres du système.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 bg-primary text-white">
                    <h3><a href="dashboard.php" class="text-white text-decoration-none">Gérer Utilisateurs</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 bg-warning text-dark">
                    <h3><a href="activity_logs.html" class="text-dark text-decoration-none">Journal d'Activité</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 bg-success text-white">
                    <h3><a href="settings.html" class="text-white text-decoration-none">Paramètres</a></h3>
                </div>
            </div>
        </div>
    </section>

    
    <section class="container my-5">
        <h2 class="text-center">Liste des Utilisateurs</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['first_name'] ?></td>
                        <td><?= $user['last_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <a href="edit_user.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="adminpage.php?delete_id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 Mon Club Universitaire. Tous droits réservés.</p>
        <p>
            <a href="#" class="text-white text-decoration-none me-3">Mentions légales</a>
            <a href="#" class="text-white text-decoration-none me-3">Politique de confidentialité</a>
            <a href="#" class="text-white text-decoration-none">Contact</a>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>