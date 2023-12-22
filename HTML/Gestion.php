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
  <form id="add-vehicle-form" class="mb-3">
    <label for="nom">Nom modèle:</label>
    <input type="text" id="nom" name="nom"  class="form-control" required>

    <label for="nbPortes">Nombre de portes:</label>
    <input type="number" id="nbPortes" name="nbPortes" class="form-control" required>

    <label for="nbPlaces">Nombre de places:</label>
    <input type="number" id="nbPlaces" name="nbPlaces" class="form-control" required>
    
    <label for="moteur" >Moteur:</label>
    <select class="form-select" name="moteur" id="moteur">
        <option value="essence">Essence</option>
        <option value="diesel">Diesel</option>
    </select>

    <label for="prix">Prix:</label>
    <input type="number" id="prix" name="prix" class="form-control" required>

    <button type="submit" class="btn btn-submit btn-primary" >Ajouter</button>
  </form>
</div>

<div class="edit">
    <h2>Modifier un véhicule</h2>
    <form id="edit-vehicle-form" class="mb-3">
        <label for="id_modele">ID modèle:</label>
        <input type="number" id="id_modele" name="id_modele"  class="form-control" required>
        <label for="nom">Nom modèle:</label>
        <input type="text" id="nom" name="nom"  class="form-control" required>

        <label for="nbPortes">Nombre de portes:</label>
        <input type="number" id="nbPortes" name="nbPortes" class="form-control" required>

        <label for="nbPlaces">Nombre de places:</label>
        <input type="number" id="nbPlaces" name="nbPlaces" class="form-control" required>

        <label for="moteur" >Moteur:</label>
        <select class="form-select" name="moteur" id="moteur">
            <option value="essence">Essence</option>
            <option value="diesel">Diesel</option>
        </select>

        <label for="prix">Prix:</label>
        <input type="number" id="prix" name="prix" class="form-control" required>

        <button type="submit" class="btn btn-submit btn-primary" >Modifier</button>
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
      <li class="list-group-item">
        <div class="d-flex justify-content-between align-items-center">
          <div>
              <strong>ID:</strong> ${vehicle.id_modele} -
              <strong>Nom du véhicule:</strong> ${vehicle.nom} -
              <strong>Nombre de portes:</strong> ${vehicle.nbPortes} -
              <strong>Moteur:</strong> ${vehicle.moteur} -
              <strong>Prix:</strong> ${vehicle.prix} -
              <strong>Nombre de places:</strong> ${vehicle.nbPlaces}
          </div>
            <button class="btn btn-danger delete" data-id="${vehicle.id_modele}">Supprimer</button>
        </div>
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

  // Fonction pour modifier un véhicule par ID
  function editVehicle(vehicleId) {
    let token = tokenExists()
    $.ajax({
      url: `http://localhost:8000/modele/modeles/${vehicleId}`,
      method: 'PUT',
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