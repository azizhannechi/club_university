<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "gestion_club";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = isset($_POST['first-name']) ? $_POST['first-name'] : '';
    $nom = isset($_POST['last-name']) ? $_POST['last-name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $cv = isset($_FILES['cv']['name']) ? $_FILES['cv']['name'] : '';
    $id_club = isset($_POST['club']) ? intval($_POST['club']) : 0 ;
    if ($id_club == 0) {
        die("Erreur : Aucun club sélectionné.");
    }
    
    $mot_de_passe = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';
    
    // Vérification si le club existe
    $stmt = $conn->prepare("SELECT COUNT(*) FROM club WHERE id_club = ?");
    $stmt->bind_param("i", $id_club);
    $stmt->execute();
    $stmt->bind_result($clubExists);
    $stmt->fetch();
    $stmt->close();

    if ($clubExists == 0) {
        die("Erreur : Le club sélectionné n'existe pas.");
    }

    // Gestion de l'upload du CV
    $cv_dir = "uploads/";
    if (!is_dir($cv_dir)) {
        mkdir($cv_dir, 0777, true);
    }
    $cv_file = $cv_dir . basename($_FILES["cv"]["name"]);
    move_uploaded_file($_FILES["cv"]["tmp_name"], $cv_file);

    // Insertion dans la base de données
    $sql = "INSERT INTO users (first_name, last_name, email, cv, club_id, ) VALUES ('$prenom', '$Nom', '$email','$prenom', '$cv', '$id_club') ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $prenom, $nom, $email, $cv_file, $id_club, $mot_de_passe);
    
    if ($stmt->execute()) {
        echo "<script>alert('Inscription réussie !'); window.location.href = 'acceuil1.html';</script>";
    } else {
        echo "Erreur : " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESSEC Clubs - Connexion</title>
    <!--boostrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--css-->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        /* Styles améliorés */
        .animated-header {
            height: 100px;
            background: #0d6efd;
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

        .login-container {
            max-width: 500px;
            margin: 5rem auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
        }

        .login-card {
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
    <form action="rejoindre.php" method="post">
        <!-- En-tête animé -->
    <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">ESSEC Clubs</h1>
            <div class="wave-effect"></div>
        </header>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <h2 class="text-center mb-4">Connexion au Club Manager</h2>

                <!-- Formulaire de connexion -->
                <form method="POST" action="process.php">
                    <div class="mb-3">
                        <label class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required autocomplete="off">
                    </div>

                    <!-- Token CSRF caché -->
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                    <button type="submit" class="btn btn-success w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
    </form>
    

    <!-- Pied de page -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2025 ESSEC Clubs. Tous droits réservés.</p>
            <p>
                <a href="#" class="text-white text-decoration-none me-3">Mentions légales</a>
                <a href="#" class="text-white text-decoration-none me-3">Contact</a>
            </p>
        </div>
    </footer>

    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
