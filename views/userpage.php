<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESSEC Clubs Manager</title>
    
    <!-- Styles et scripts externes -->
    <!--boostrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--css-->
    <link rel="stylesheet" href="assets/css/infolab.css">
    <style>
        /* Styles personnalisés */
        .sidebar {
            height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .main-content { padding: 20px; }
        .stat-card { transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }

        /* Styles header animé */
        .animated-header {
            height: 100px;
            background: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .animated-text {
            font-size: 4rem;
            background: linear-gradient(90deg, 
                rgba(255,255,255,1) 0%, 
                rgba(255,255,255,0.8) 50%, 
                rgba(255,255,255,1) 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: shine 3s infinite;
        }
        .wave-effect {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1000 100" xmlns="http://www.w3.org/2000/svg"><path fill="%23ffffff" opacity="0.25" d="M 0 50 Q 250 0 500 50 T 1000 50 L 1000 100 L 0 100 Z"></path></svg>');
            animation: wave 10s infinite linear;
        }
        @keyframes shine {
            0% { background-position: -500px; }
            100% { background-position: 500px; }
        }
        @keyframes wave {
            0% { transform: translateX(0); }
            100% { transform: translateX(-1000px); }
        }
    </style>
</head>

<body>
    <!-- En-tête animé -->
    <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="animated-text display-1 text-center">Bienvenue au page utilisateur</h1>
            <div class="wave-effect"></div>
        </header>
    </div>

    <!-- Navigation principale -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <ul class="navbar-nav">
                <img src="assets/imgs/profil.jpg" class="img-fluid rounded-circle" alt="Logo" width="10%">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="acceuil.html">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="infolab.html">InfoLab</a></li>
                        <li class="nav-item"><a class="nav-link" href="enactus.html">Enactus</a></li>
                        <li class="nav-item"><a class="nav-link" href="radio.html">Radio</a></li>
                    </ul>
                </div>
            </ul>
            <form class="d-flex ms-3">
                <a href="logout.php" class="btn btn-outline-light me-2">Déconnexion</a>
            </form>
        </div>
    </nav>
    
    <!-- Contenu principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
<!-- Contenu dynamique -->
<div class="col-md-9 main-content">
    <!-- Ajoutez ici -->
    <main class="container mt-4">
        <!-- Ajoutez cette section après la fermeture de la div .card -->
<div class="row mt-5">
</div>
<section class="container my-5 text-center">
        <h2>Votre espace personnel</h2>
        <p>Gérez vos activités et explorez les clubs disponibles à l'ESSECT.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 bg-primary text-white">
                    <h3><a href="rejoindre un club.php" class="text-white text-decoration-none">InfoLab</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 bg-warning text-dark">
                    <h3><a href="rejoindre un club.php" class="text-dark text-decoration-none">Enactus</a></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card p-4 bg-success text-white">
                    <h3><a href="rejoindre un club.php" class="text-white text-decoration-none">Radio</a></h3>
                </div>
            </div>
        </div>
    </section>
    </main>
</div>
            <!-- Contenu dynamique -->
            <div class="col-md-9 main-content">
                <!-- Sections de contenu... (identique à votre version originale) -->
            </div>
        </div>
    </div>
    

    <!-- Pied de page -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-1">&copy; 2025 Mon Club Universitaire. Tous droits réservés.</p>
            <p>
                <a href="#" class="text-white text-decoration-none me-3">Mentions légales</a>
                <a href="#" class="text-white text-decoration-none me-3">Politique de confidentialité</a>
                <a href="#" class="text-white text-decoration-none">Contact</a>
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>