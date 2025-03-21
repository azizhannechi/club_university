<?php
require_once __DIR__ . '/../controllers/membrecontroller.php';

// Initialiser le contrôleur des membres
$memberController = new MemberController();
$membres_par_club = $memberController->getMembresParClub();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Membres</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<style>
            /* Réutilisation des styles de la page principale */
            .animated-header {
                height: 100px;
                background: #ea2c36;
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
            @keyframes wave {
                0% { transform: translateX(0); }
                100% { transform: translateX(-1000px); }
            }
    </style>
<body>
    <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">Liste des membre inscris</h1>
            <div class="wave-effect"></div>
        </header>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link active" href="adminpage.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="membre.php">Gérer les membres</a></li>
                <li class="nav-item"><a class="nav-link" href="paramétre.php">Paramètres</a></li>
            </ul>
            <form class="d-flex ms-auto">
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </form>
        </div>
    </nav>
    <div class="container">
        <h1 class="mt-5">Liste des Membres par Club</h1>

        <?php if (!empty($membres_par_club)): ?>
            <?php foreach ($membres_par_club as $nom_club => $membres): ?>
                <h3 class="mt-4"><?= htmlspecialchars($nom_club) ?> (<?= count($membres) ?> membres)</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($membres as $membre): ?>
                            <>
                                <td><?= htmlspecialchars($membre["id"]) ?></td>
                                <td><?= htmlspecialchars($membre["nom"]) ?></td>
                                <td><?= htmlspecialchars($membre["prenom"]) ?></td>
                                <td><?= htmlspecialchars($membre["email"]) ?></td>
                                <td><a href="dashboard.php?delete_id=<?= $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun membre inscrit.</p>
        <?php endif; ?>
    </div>
</body>
<footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2025 ESSEC Clubs. Tous droits réservés.</p>
            <p>
                <a href="#" class="text-white text-decoration-none me-3">Mentions légales</a>
                <a href="#" class="text-white text-decoration-none me-3">Contact</a>
            </p>
        </div>
    </footer>
</html>
