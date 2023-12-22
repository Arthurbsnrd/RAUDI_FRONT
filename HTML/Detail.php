<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAUDI</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" type="text/css" href="../CSS/Detail.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <header>
        <?php include("../includes/nav.php"); ?>
    </header>

    <h1>Détail de la voiture</h1>

    <div id="detail-voiture">
        <!-- Les détails de la voiture seront affichés ici -->
    </div>

    <div id="btn-achat">

    </div>
    <script>
        // Récupérer l'ID de la voiture depuis l'URL (par exemple, /HTML/Detail.html?id=1)
        var urlParams = new URLSearchParams(window.location.search);
        var idVoiture = urlParams.get('id');

        // Utilisation de jQuery pour effectuer une requête AJAX
        $(document).ready(function() {
            // Conditionner la requête en fonction de la présence ou de l'absence d'un token
            if (tokenExists()) {
                let token = tokenExists()
                // Requête pour les détails de la voiture (cas où l'utilisateur est connecté)
                $.ajax({
                url: "http://localhost:8000/modele/modeles/" + idVoiture + "/options",
                method: "GET",
                headers: {
                    "Authorization":  token
                },
                success: function(voiture) {
                    let test = displayCarDetails(voiture);
                    displayOptions(voiture.options);
                },
                error: function(err) {
                    console.error("Erreur lors de la récupération des détails de la voiture:", err.responseJSON.message);
                }
            });
            } else {
                // Requête pour les options de la voiture (cas où l'utilisateur n'est pas connecté)
                $.get("http://localhost:8000/modele/modeles/" + idVoiture, function(voiture) {
                    displayCarDetailsNoCo(voiture);
                    ; // Supposons que les options sont disponibles dans l'objet voiture
                });
            }
        });

        // Fonction pour vérifier si un token existe
        function tokenExists() {
            // Assurez-vous que le token est stocké localement lors de la connexion
            let token = localStorage.getItem('token'); 
            return token;
        }

        function displayCarDetailsNoCo(voiture) {
            console.log(voiture);
            var detailVoiture = $("#detail-voiture");
            var carCard = $("<div class='car-card'></div>");
            carCard.append("<h2>" + voiture.nom + "</h2>");
            carCard.append("<p> Moteur: " + voiture.moteur + "</p>");
            carCard.append("<p> Prix: " + voiture.prix + " €</p>");
            carCard.append("<p> Nombre de portes: " + voiture.nbPortes + " portes</p>");
            carCard.append("<p> Nombre de places: " + voiture.nbPlaces + " places</p>");
            detailVoiture.append(carCard);
        }

        // Fonction pour afficher les détails de la voiture
        function displayCarDetails(voiture) {
            console.log(voiture);
            var detailVoiture = $("#detail-voiture");
            let achat = $("#btn-achat");
            let btnAchat = $("<button id='btn-achat' class='btn-achat' onclick='acheter()'>Acheter</button>");
            var carCard = $("<div class='car-card'></div>");
            carCard.append("<h2>" + voiture.modeleFound.nom + "</h2>");
            carCard.append("<p> Moteur: " + voiture.modeleFound.moteur + "</p>");
            carCard.append("<p> Prix: " + voiture.modeleFound.prix + " €</p>");
            carCard.append("<p> Nombre de portes: " + voiture.modeleFound.nbPortes + " portes</p>");
            carCard.append("<p> Nombre de places: " + voiture.modeleFound.nbPlaces + " places</p>");
            detailVoiture.append(carCard);
            achat.append(btnAchat);
        }

        // Fonction pour afficher les options de la voiture
        function displayOptions(options) {
            console.log(options)
            var optionsSection = $("<div id='options-section'><h2>Options disponibles</h2><ul></ul></div>");
            var optionsList = options.map(function(option) {
                return `
                    <li>
                        <h4>
                            <input type='checkbox' name='options' value=' ${option.Option.id_option} '> ${option.Option.nom}  ${option.Option.prix} € 
                        </h4>
                    </li>`;
            });
            optionsSection.find("ul").append(optionsList);
            $("#detail-voiture").append(optionsSection);
        }

        function acheter() {
    // Récupérer l'ID de la voiture depuis l'URL (par exemple, /HTML/Detail.html?id=1)
    var urlParams = new URLSearchParams(window.location.search);
    var idVoiture = urlParams.get('id');
    
    // Récupérer les options sélectionnées
    var options = [];
    $("input[name='options']:checked").each(function() {
        options.push($(this).val().trim());
    });

    // Récupérer le token
    let token = localStorage.getItem('token');

    // Requête pour l'achat de la voiture
    var url = "http://localhost:8000/achat/acheter/" + idVoiture;
    var requestData = {
        id_modele: idVoiture,
        options: options || [] // Utiliser options ou un tableau vide si options n'est pas défini
    };

    $.ajax({
        url: url,
        method: "POST",
        headers: {
            "Authorization":  token
        },
        data: requestData,
        success: function() {
            alert("Achat effectué avec succès");
        },
        error: function(err) {
            console.error("Erreur lors de l'achat de la voiture:", err.responseJSON.message);
        }
    });
}


            
    </script>
</body>
</html>
