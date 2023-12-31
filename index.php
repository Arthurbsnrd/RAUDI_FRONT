<!Doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>RAUDI</title>
        <link rel="stylesheet" href="./css/style.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> <!-- Ajout de jQuery pour faciliter les requêtes AJAX -->
    </head>
    <body>            
        <header>
            <?php include("./includes/navIndex.php"); ?>
        </header>
        

        <section id="voitures-section">
            <!-- Les données des voitures seront affichées ici -->
        </section>
    
        <script>
            // Utilisation de jQuery pour effectuer une requête AJAX
            $(document).ready(function() {
                // Effectuer une requête GET vers le serveur Node.js
                $.get("http://localhost:8000/modele/modeles", function(data) {
                    // Manipuler les données reçues et les afficher dans la section dédiée
                    var voituresSection = $("#voitures-section");
                    data.forEach(function(voiture) {
                        // Créer une carte pour chaque voiture
                        var carCard = $("<div class='car-card'></div>");
                        carCard.append("<h2>" + voiture.nom + "</h2>");
                        carCard.append("<p> Moteur: " + voiture.moteur + "</p>");
                        carCard.append("<a href='./HTML/Detail.php?id=" + voiture.id_modele + "'>Voir les détails</a>");
    
                        // Ajouter la carte à la section des voitures
                        voituresSection.append(carCard);
                    });
                });
            });


        </script>
        

        <footer>
            <div class="conteneur">
                <br>
                <p>© 2023. Tous droits réservés.</p>
            </div>
        </footer>
    </body>
</html>