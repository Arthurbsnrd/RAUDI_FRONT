<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAUDI</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Comptabilité.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <header>
        <?php include("../includes/nav.php"); ?>
    </header>
    <div class="comptable">

        <h1>Comptabilité</h1>
    
        <div id="historique-achats">
            <h2>Historique des achats</h2>
            <ul id="achats-list"></ul>
        </div>
    
        <div id="gain-total-mois">
            <h2>Compte rendu du gain total par mois</h2>
            <ul id="gain-mois-list"></ul>
        </div>
    </div>

    <script>
        // Fonction pour récupérer l'historique des achats
        function getHistoriqueAchats() {
            let token = tokenExists()
            $.ajax({
                url: "http://localhost:8000/achat/achats",
                method: "GET",
                headers: {
                    "Authorization":  token
                },
                success: function(achats) {
                    displayAchats(achats);
                },
                error: function(err) {
                    console.error("Erreur lors de la récupération des détails de la voiture:", err.responseJSON.message);
                }
            });
        }

        // Fonction pour récupérer le compte rendu du gain total par mois
        function getGainTotalMois() {
            let token = tokenExists()
            $.ajax({
                url: "http://localhost:8000/achat/achats/total",
                method: "GET",
                headers: {
                    "Authorization":  token
                },
                success: function(gainMois) {
                    displayGainMois(gainMois);
                },
                error: function(err) {
                    console.error("Erreur lors de la récupération des détails de la voiture:", err.responseJSON.message);
                }
            });
        }

        // Fonction pour afficher l'historique des achats
        function displayAchats(achats) {
            console.log(achats);
            var achatsList = $("#achats-list");
            achatsList.empty();
            if (achats.length == 0) {
                achatsList.append("<li>Aucun achat effectué</li>");
            } else {
                for (var i = 0; i < achats.length; i++) {
                    var date = new Date(achats[i].createdAt); // Récupère la date de création de l'achat

                    var jour = date.getDate(); // Récupère le jour du mois (1-31)
                    var mois = date.getMonth() + 1; // +1 car les mois commencent à 0
                    var annee = date.getFullYear(); // Récupère l'année (4 chiffres)

                    // Formatage manuel de la date en "d-m-Y"
                    var dateFormatee = (jour < 10 ? '0' : '') + jour + '-' + (mois < 10 ? '0' : '') + mois + '-' + annee;

                    
                    achatsList.append(`
                        <li class="list-group-item">
                            <strong>Prix:</strong> ${achats[i].prixtotal} - 
                            <strong>Date:</strong> ${dateFormatee}
                        </li>
                    `);

                }
            }
        }

        // Fonction pour afficher le compte rendu du gain total par mois
        function displayGainMois(gainMois) {
            console.log(gainMois);
            var gainMoisList = $("#gain-mois-list");
            gainMoisList.empty();
            // recupere le mois actuel pour calculer le gain du mois
            var date = new Date();
            var mois = date.getMonth() + 1; // +1 car les mois commencent à 0
            var annee = date.getFullYear(); // Récupère l'année (4 chiffres)
            var dateFormatee = (mois < 10 ? '0' : '') + mois + '-' + annee;
            gainMoisList.append(`
                <li class="list-group-item">
                    <strong>Gain total du mois:</strong> ${gainMois} - 
                    <strong>Mois:</strong> ${dateFormatee}
                </li>
            `);
        }

        // Appeler les fonctions pour récupérer et afficher les données
        getHistoriqueAchats();
        getGainTotalMois();

        // Fonction pour vérifier si un token existe
        function tokenExists() {
            // Assurez-vous que le token est stocké localement lors de la connexion
            let token = localStorage.getItem('token'); 
            return token;
        }
    </script>

    <!-- ... votre code HTML suivant ... -->
</body>
</html>
