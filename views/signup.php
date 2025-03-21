<?php
require_once __DIR__ . '/../controllers/usercontroller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $result = $controller->register(first_name: $_POST['first-name'], last_name: $_POST['last-name'], email: $_POST['email'], password: $_POST['password']);

    if ($result === true){
        echo "<div><h3>Inscription réussie bienvenue .</h3>
    <p>Cliquez ici pour vous <a href='login.php'>connecter</a></p>";
      } else {
        echo $result; // Affiche l'erreur
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESSEC Clubs - Inscription</title>
    
   <!--boostrap css -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!--css-->
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Réutilisation des styles de la page principale */
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
    <!-- En-tête animé identique -->
    <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">ESSECT Clubs</h1>
            <div class="wave-effect"></div>
        </header>
    </div>

    <!-- Contenu principal -->
    <div class="container">
        <div class="signup-container">
            <div class="signup-card">
                <h2 class="text-center mb-4">S'inscrire </h2>
                
                <!-- Formulaire d'inscription -->
                <form method="post" action="signup.php">
                    <!-- Prénom -->
                    <div class="mb-3">
                        <label for="first-name" class="form-label">Prénom</label>
                        <input type="text" 
                               class="form-control" 
                               id="first-name"
                               name="first-name"
                               placeholder="Votre prénom"
                               required>
                    </div>

                    <!-- Nom -->
                    <div class="mb-3">
                        <label for="last-name" class="form-label">Nom</label>
                        <input type="text" 
                               class="form-control" 
                               id="last-name"
                               name="last-name"
                               placeholder="Votre nom"
                               required>
                    </div>

                    <!-- Adresse email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse ESSEC</label>
                        <input type="email" 
                               class="form-control" 
                               id="email"
                               name="email"
                               placeholder="prenom.nom@essec.tn"
                               required>
                    </div>

                    <!-- Mot de passe -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" 
                               class="form-control" 
                               id="password"
                               name="password"
                               required>
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="mb-4">
                        <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" 
                               class="form-control" 
                               id="confirm-password"
                               name="confirmpassword"
                               required>
                    </div>

                    <!-- Bouton d'inscription -->
                    <button type="submit" class="btn btn-essec w-100 py-2">
                        S'inscrire
                    </button>

                    <!-- Lien connexion -->
                    <div class="row">
                        <small>vous avez deja un compte ? <a href="login.php">se connecter</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </body>
    <!-- Pied de page identique -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2025 ESSEC Clubs. Tous droits réservés.</p>
            <p>
                <a href="#" class="text-white text-decoration-none me-3">Mentions légales</a>
                <a href="#" class="text-white text-decoration-none me-3">Contact</a>
            </p>
        </div>
    </footer>
  <!--boostrap js-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
     <script>
              document.querySelector('form').addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        // Vérification de l'email
        if (!email.endsWith('@essec.tn')) {
            const alert = new bootstrap.Alert(document.createElement('div'));
            alert._element.className = 'alert alert-danger';
            alert._element.innerHTML = "L'email doit se terminer par '@essec.tn'.";
            document.body.prepend(alert._element);
            event.preventDefault();
            return;
        }

        // Vérification de la confirmation du mot de passe
        if (password !== confirmPassword) {
            const alert = new bootstrap.Alert(document.createElement('div'));
            alert._element.className = 'alert alert-danger';
            alert._element.innerHTML = "Les mots de passe ne correspondent pas.";
            document.body.prepend(alert._element);
            event.preventDefault();
        }
    });
     </script>
    <!--js-->
    <script src="../assets/js/main.js"></script>
</footer>
</html>
