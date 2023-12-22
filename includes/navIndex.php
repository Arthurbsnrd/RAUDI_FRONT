<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand active" href="#">Raudi</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Voitures</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Authentification
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="./HTML/Inscription.php">Inscription</a></li>
                <li><a class="dropdown-item" href="./HTML/Connexion.php">Connexion</a></li>
            </ul>
        </li>
        <li id="gestion" class="nav-item"></li>
        <li id="comptable" class="nav-item"></li>
      </ul>
      <li class="" id="logoutButtonContainer"></li>
    </div>
  </div>
</nav>


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
            logoutButtonContainer.innerHTML = '<button class="btn btn-danger" onclick="logout()">Déconnexion</button>';
            // verifie si l'utilisateur est un comptable
            $.ajax({
                url: "http://localhost:8000/user/users/check/role",
                method: "GET",
                headers: {
                    "Authorization":  token
                },
                success: function(data) {
                    if (data.role == 1) {
                        let gestion = document.getElementById('gestion');
                        gestion.innerHTML = '<a class="nav-link"  href="./HTML/Comptabilité.php">Comptabilité</a>';
                    }
                    if (data.role == "99") {
                        let comptable = document.getElementById('comptable');
                        let gestion = document.getElementById('gestion');
                        comptable.innerHTML = '<a class="nav-link"  href="./HTML/Comptabilité.php">Comptabilité</a>';
                        gestion.innerHTML = '<a class="nav-link"  href="./HTML/Gestion.php">Gestion</a>';
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
