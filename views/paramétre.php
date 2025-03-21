<?php
require_once '../config/config.php';

$conn = Database::getConnection();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $site_name = $_POST['site_name'];
    $admin_email = $_POST['admin_email'];

    $sql = "UPDATE paramétre SET site_name = ?, admin_email = ? WHERE id = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $site_name, $admin_email);

    if ($stmt->execute()) {
        $message = "Paramètres mis à jour avec succès.";
    } else {
        $message = "Erreur lors de la mise à jour : " . $conn->error;
    }
}

// Récupérer les paramètres actuels
$sql = "SELECT * FROM paramétre WHERE id = 1";
$result = $conn->query($sql);
$paramétre = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Administrateur</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
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
    </nav>
        
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
