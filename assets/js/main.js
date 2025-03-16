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