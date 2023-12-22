<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<div class="conteneur">
    <div class="haut-gauche">
        <a href="../index.php">
            <h1>RAUDI</h1>
        </a>
    </div>
    <div class="clear"></div>
    <nav>
        <ul>
            <li><a href="./index.php">Voitures</a></li>
            <li><a href="./HTML/Inscription.php">Inscription</a></li>
            <li><a href="./HTML/Connexion.php">Connexion</a></li>
            <li id="gestion"></li>
            <li id="comptable"></li>
            <li id="logoutButtonContainer">
                
            </li>
        </ul>
    </nav>
</div>

<script defer>

    function logout() {
        localStorage.removeItem('token');
        alert("Vous êtes bien déconnecté !");
        window.location.href = "./index.php";
    }
    function navBar(){
        var token = localStorage.getItem('token');

        // Si le token est présent, afficher le bouton de déconnexion
        if (token) {
            let logoutButtonContainer = document.getElementById('logoutButtonContainer');
            logoutButtonContainer.style.display = 'block';
            logoutButtonContainer.innerHTML = '<button onclick="logout()">Déconnexion</button>';
            // verifie si l'utilisateur est un comptable
            $.ajax({
                url: "http://localhost:8000/user/users/check/role",
                method: "GET",
                headers: {
                    "Authorization":  token
                },
                success: function(data) {
                    if (data.role == "1") {
                        let gestion = document.getElementById('gestion');
                        gestion.innerHTML = '<a href="./HTML/Gestion.php">Gestion</a>';
                    }
                    if (data.role == "99") {
                        let comptable = document.getElementById('comptable');
                        let gestion = document.getElementById('gestion');
                        comptable.innerHTML = '<a href="./HTML/Comptabilité.php">Comptabilité</a>';
                        gestion.innerHTML = '<a href="./HTML/Gestion.php">Gestion</a>';
                    }
                },
                error: function(err) {
                    console.error("Erreur lors de la récupération des détails de la voiture:", err.responseJSON.message);
                }
            });
        } else {
            let logoutButtonContainer = document.getElementById('logoutButtonContainer');
            logoutButtonContainer.innerHTML = '';
        }
    }

    navBar();
    document.addEventListener("DOMContentLoaded", function() {
        // Vérifier si le token est présent dans le stockage local
       
    });

</script>
