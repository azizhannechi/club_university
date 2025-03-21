<?php
require_once '../config/config.php';

$conn = Database::getConnection();

// Récupérer les logs d'activité
$sql = "SELECT * FROM activity_logs ORDER BY created_at DESC";
$result = $conn->query($sql);

// Vérifier si la requête a échoué
if (!$result) {
    die("Erreur SQL : " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>journal d'activité </title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
    <header>
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
    
            .signup-container {
                max-width: 500px;
                margin: 5rem auto;
                box-shadow: 0 0 20px rgba(0,0,0,0.1);
                border-radius: 15px;
                overflow: hidden;
            }
    
            .signup-card {
                padding: 2.5rem;
                background: rgba(255,255,255,0.95);
            }
    
            .btn-essec {
                background: #0d6efd;
                color: white;
                transition: transform 0.3s ease;
            }
    
            .btn-essec:hover {
                transform: translateY(-2px);
                color: white;
            }
    
            @keyframes wave {
                0% { transform: translateX(0); }
                100% { transform: translateX(-1000px); }
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
                <li class="nav-item"><a class="nav-link" href="membre.php">Gérer les membres</a></li>
                <li class="nav-item"><a class="nav-link" href="paramétre.php">Paramètres</a></li>
            </ul>
            <form class="d-flex ms-auto">
                <a href="logout.php" class="btn btn-outline-light">Déconnexion</a>
            </form>
        </div>
    </nav
        
        <?php if (isset($message)): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="post" class="mt-3">
            <div class="mb-3">
                <label for="site_name" class="form-label">Nom du Site :</label>
                <input type="text" class="form-control" id="site_name" name="site_name" value="<?= htmlspecialchars($paramétre['site_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="admin_email" class="form-label">Email Administrateur :</label>
                <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?= htmlspecialchars($paramétre['admin_email']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>
