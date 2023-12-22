<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="/CSS/Inscription.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <header>
        <?php include("../includes/nav.php"); ?>
    </header>

    <h1>Connexion</h1>

    <form id="connexion-form">
        <label for="mail">Adresse e-mail:</label>
        <input type="email" id="mail" name="mail" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="button" onclick="submitForm()">Se connecter</button>
    </form>

    <script>
        function submitForm() {
            var mail = document.getElementById('mail').value;
            var password = document.getElementById('password').value;

            // Effectuer la requête AJAX pour la connexion de l'utilisateur
            $.ajax({
                url: 'http://localhost:8000/user/login',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ mail, password }),
                success: function(data) {
                    console.log('Connexion réussie. Token reçu:', data.token);
                    // Stocker le token localement (par exemple, dans localStorage)
                    localStorage.setItem('token', data.token);
                    // Rediriger vers une autre page, afficher un message, etc., en fonction de vos besoins
                },
                error: function(err) {
                    console.error('Erreur lors de la connexion:', err.responseJSON.message);
                    // Afficher un message d'erreur à l'utilisateur, rediriger, etc., en fonction de vos besoins
                }
            });
        }
    </script>
</body>
</html>
