<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Inscription.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
        <header>
            <?php include("../includes/nav.php"); ?>
        </header>

    <h1>Inscription</h1>

    <form id="inscription-form">
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required>

        <label for="mail">Adresse e-mail:</label>
        <input type="email" id="mail" name="mail" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="button" onclick="submitForm()">S'inscrire</button>
    </form>

    <script>
        function submitForm() {
            var pseudo = document.getElementById('pseudo').value;
            var mail = document.getElementById('mail').value;
            var password = document.getElementById('password').value;

            // Effectuer la requête AJAX pour créer un nouvel utilisateur
            $.ajax({
                url: 'http://localhost:8000/user/registre',
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ pseudo, mail, password }),
                success: function(data) {
                    console.log('Utilisateur créé avec succès:');
                    // Rediriger vers une autre page, afficher un message, etc., en fonction de vos besoins
                },
                error: function(err) {
                    console.error('Erreur lors de la création de l\'utilisateur:', err.responseJSON.message);
                    // Afficher un message d'erreur à l'utilisateur, rediriger, etc., en fonction de vos besoins
                }
            });
        }
    </script>
</body>
</html>