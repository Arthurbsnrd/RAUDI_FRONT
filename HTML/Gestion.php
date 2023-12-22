<!DOCTYPE html>
<html>
<head>
    <title>Gestion</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Gestion.css">
</head>
<body>
    <header>
        <?php include("../includes/nav.php"); ?>
    </header>
    
    <div id="vehicles-list">
  <h2>Liste des Véhicules</h2>
  <ul id="vehicles-ul"></ul>
</div>

<div id="vehicle-form">
  <h2>Ajouter un Nouveau Véhicule</h2>
  <form id="add-vehicle-form">
    <label for="nom">Nom modèle:</label>
    <input type="text" id="nom" name="nom" required>

    <label for="nbPortes">Nombre de portes:</label>
    <input type="number" id="nbPortes" name="nbPortes" required>

    <label for="nbPlaces">Nombre de places:</label>
    <input type="number" id="nbPlaces" name="nbPlaces" required>
    
    <label for="moteur">Moteur:</label>
    <select name="moteur" id="moteur">
        <option value="essence">Essence</option>
        <option value="diesel">Diesel</option>
    </select>

    <label for="prix">Prix:</label>
    <input type="number" id="prix" name="prix" required>

    <button type="submit">Ajouter</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function () {
  // Chargement initial des véhicules
  loadVehicles();

  // Soumettre le formulaire d'ajout de véhicule
  $('#add-vehicle-form').submit(function (event) {
    event.preventDefault();

    const nom = $('#nom').val();
    const nbPortes = $('#nbPortes').val();
    const nbPlaces = $('#nbPlaces').val();
    const moteur = $('#moteur').val();
    const prix = $('#prix').val();

    // Ajouter le nouveau véhicule
    addVehicle({ nom, nbPortes, moteur, prix, nbPlaces });
  });

  // Fonction pour charger les véhicules depuis le serveur
  function loadVehicles() {
    $.get('http://localhost:8000/modele/modeles', function (vehicles) {
      displayVehicles(vehicles);
    });
  }

  // Fonction pour afficher les véhicules dans la liste
  function displayVehicles(vehicles) {
    const $vehiclesList = $('#vehicles-ul');
    $vehiclesList.empty();

    vehicles.forEach(function (vehicle) {
      $vehiclesList.append(`
      <li>
        Nom du véhicule: ${vehicle.nom} -
        Nombre de portes: ${vehicle.nbPortes} - 
        Moteur: ${vehicle.moteur} - 
        Prix: ${vehicle.prix} - 
        Nombre de places: ${vehicle.nbPlaces} 
        <button class="delete" data-id="${vehicle.id_modele}">Supprimer</button>
    </li>`);
    });

    // Attacher un gestionnaire d'événements pour supprimer un véhicule
    $('.delete').click(function () {
      const vehicleId = $(this).data('id');
      deleteVehicle(vehicleId);
    });
  }

  // Fonction pour ajouter un nouveau véhicule
    function addVehicle(vehicle) {
    let token = tokenExists();
    $.ajax({
        url: "http://localhost:8000/modele/modeles",
        method: "POST",
        headers: {
        "Authorization": token
        },
        data: {
            nom: vehicle.nom,
            nbPortes: vehicle.nbPortes,
            moteur: vehicle.moteur,
            nbPlaces: vehicle.nbPlaces,  // Assurez-vous que nbPlaces est correctement défini
            prix: vehicle.prix,
            nbPlaces: vehicle.nbPlaces
        },
        success: function (newVehicle) {
            loadVehicles();
        },
        error: function (err) {
            console.error("Erreur lors de la récupération des détails de la voiture:", err.responseJSON.message);
        }
    });
    }


  // Fonction pour supprimer un véhicule par ID
  function deleteVehicle(vehicleId) {
    let token = tokenExists()
    $.ajax({
      url: `http://localhost:8000/modele/modeles/${vehicleId}`,
      method: 'DELETE',
        headers: {
            "Authorization":  token
        },
      success: function () {
        loadVehicles();
      }
    });
  }

  // Fonction pour vérifier si un token existe
    function tokenExists() {
        // Assurez-vous que le token est stocké localement lors de la connexion
        let token = localStorage.getItem('token'); 
        return token;
    }
});

</script>