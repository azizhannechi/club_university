<?php
require_once '../config/config.php'; // Inclure la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe']; 
    $id_club = $_POST['club_id'];

    // Vérification de la connexion à la base de données
    $conn = Database::getConnection();

    // Vérifier si l'email existe déjà
    $checkEmail = $conn->prepare("SELECT id FROM membres WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();
    
    if ($checkEmail->num_rows > 0) {
        echo "Erreur : Cet email est déjà utilisé.";
    } else {
        // Insérer le membre
        $stmt = $conn->prepare("INSERT INTO membres (nom, prenom, email, mot_de_passe, club_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $nom, $prenom, $email, $mot_de_passe, $id_club);

        if ($stmt->execute()) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription.";
        }

        $stmt->close();
    }

    $checkEmail->close();
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!--css-->
    <link rel="stylesheet" href="../assets/css/style.css">

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
    <form action="rejoindre un club.php" method="post">
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
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">prenom</label>
                        <input type="text" class="form-control" name="prenom" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" name="mot_de_passe" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                <label class="form-label">Club</label>
                <select class="form-control" name="club_id" required>
                <?php
                // Connexion à la base de données
                 $conn = new mysqli("localhost", "root", "", "gestion_club");
                 if ($conn->connect_error) {
                   die("Échec de la connexion : " . $conn->connect_error);
                   }

           // Récupérer la liste des clubs
                 $sql = "SELECT club_id, club_name FROM clubs";
                 $result = $conn->query($sql);

                 if ($result->num_rows > 0) {
                 while ($row = $result->fetch_assoc()) {
                    // Afficher chaque club comme une option dans la barre de sélection
                 echo "<option value='" . $row["club_id"] . "'>" . $row["club_name"] . "</option>";
                  }
                } else {
                // Si aucun club n'est trouvé, afficher une option par défaut
                echo "<option value=''>Aucun club disponible</option>";
               }

               // Fermer la connexion
            $conn->close();
           ?>
                   <option value="">Sélectionnez un club</option>
                   <option value="1">Infolab</option>
                   <option value="2">Enactus</option>
                   <option value="3">Club Radio</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">CV (fichier PDF)</label>
                    <input type="file" class="form-control" name="cv_file" accept=".pdf" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description du CV</label>
                    <textarea class="form-control" name="cv" rows="4" required></textarea>
                </div>


                    <!-- Token CSRF caché -->
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                    <button type="submit" class="btn btn-success w-100">inscription</button>
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
