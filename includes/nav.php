<div class="conteneur">
    <div class="haut-gauche">
        <a href="../index.php">
            <h1>RAUDI</h1>
        </a>
    </div>
    <div class="clear"></div>
    <nav>
        <ul>
            <li><a href="../HTML/Inscription.php">Inscription</a></li>
            <li><a href="../HTML/Connexion.php">Connexion</a></li>
            <li><a href="../HTML/Gestion.php">Gestion</a></li>
            <li><a href="../HTML/Comptabilité.php">Comptabilité</a></li>
            <li>
                <button onclick="logout()">Déconnexion</button>
            </li>
        </ul>
    </nav>
</div>

<script>
    function logout() {
        localStorage.removeItem('token');
        window.location.href = "./index.html";
    }
</script>
