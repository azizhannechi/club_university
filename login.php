<?php
require_once __DIR__ . '/controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $controller = new UserController();
    $role = $controller->login($email, $password);

    if ($role === 'admin') {
        header('Location: views/adminpage.php');
    } elseif ($role === 'user') {
        header('Location: views/userpage.php');
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESSECT club - se connecter</title>

    <!--boostrap css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--css-->
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
       <!-- En-tête animé identique -->
       <div class="container-fluid p-0">
        <header class="animated-header">
            <h1 class="text-white display-4">ESSECT Clubs</h1>
            <div class="wave-effect"></div>
        </header>
    </div>
    <!----------------------- Main Container -------------------------->
     <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
    <!--------------------------- Left Box ----------------------------->
       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
           <div class="featured-image mb-3">
            <img src="assets/imgs/pexels-pixabay-163097.jpg" class="img-fluid" style="width: 250px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
       </div> 
    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Salut</h2>
                     <p>Ravi de vous Revoir !!</p>
                </div>
                <form method="post" action="login.php">
                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-lg bg-light fs-6" id="email "name="email" placeholder="Address mail">
                </div>
                <div class="input-group mb-1">
                    <input type="password" class="form-control form-control-lg bg-light fs-6" id="password" name="password" placeholder="Mot de passe">
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck" class="form-check-label text-secondary"><small>souvenez de moi</small></label>
                    </div>
                    <div class="forgot">
                        <small><a href="#">mot de passe oublié ?</a></small>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6" name="seconnecter">se connecter</button>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-light w-100 fs-6"><small>se connecter avec Google</small></button>
                </div>
                <div class="row">
                    <small>Vous n'avez pas de compte ? <a href="signup.php">S'inscrire</a></small>
                </div>
                </form>
          </div>
       </div> 
      </div>
    </div>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
body{
    font-family: 'Poppins', sans-serif;
    background: #ececec;
}
/*------------ Login container ------------*/
.box-area{
    width: 930px;
}
/*------------ Right box ------------*/
.right-box{
    padding: 40px 30px 40px 40px;
}
/*------------ Custom Placeholder ------------*/
::placeholder{
    font-size: 16px;
}
.rounded-4{
    border-radius: 20px;
}
.rounded-5{
    border-radius: 30px;
}
/*------------ For small screens------------*/
@media only screen and (max-width: 768px){
     .box-area{
        margin: 0 10px;
     }
     .left-box{
        height: 100px;
        overflow: hidden;
     }
     .right-box{
        padding: 20px;
     }
}
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
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script>
    let attempts = 0;
    const maxAttempts = 3;

    document.querySelector('form').addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        fetch('login.php', {
            method: 'POST',
            body: new FormData(document.querySelector('form'))
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                window.location.href = 'userpage.php';
            } else if (data === 'admin') {
                window.location.href = 'adminpage.php';
            } else {
                attempts++;
                alert(`Identifiants incorrects. Tentative ${attempts} sur ${maxAttempts}.`);
                if (attempts >= maxAttempts) {
                    document.querySelector('button[name="seconnecter"]').disabled = true;
                }
            }
        });

        event.preventDefault();
    });
</script>
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