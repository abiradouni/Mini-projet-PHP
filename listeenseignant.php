<?php
require_once 'config.php';
require_once 'enseignant.php';

// Créer une instance de la classe Enseignant
$enseignants = Enseignant::getListeEnseignants();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des enseignants</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
    </style>
</head>
<body> <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home.html">Welcome</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="ajouter_etudiant.php">Ajouter Etudiant</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ajouter_matiere.php">Ajouter Matiere</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="ajouter_enseignant.php">Ajouter Enseignant</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>



    <div class="container">
        <h1>Liste des enseignants</h1>
        <?php if (count($enseignants) > 0) { ?>
            <table class="table  table-striped">
                <thead class="thead-dark">
                    <tr>
                        <!--th>Code Enseignant</th-->
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de Recrutement</th>
                        <th> Adresse </th>
                        <th>Mail</th>
                        <th>Tel</th>
                        <th>Code Département</th>
                        <th>Code Grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enseignants as $enseignant) { ?>
                        <tr>
                            <!--td><?php echo $enseignant->CodeEnseignant; ?></td-->
                            <td><?php echo $enseignant->Nom; ?></td>
                            <td><?php echo $enseignant->Prenom; ?></td>
                            <td><?php echo $enseignant->DateRecrutement; ?></td>
                            <td><?php echo $enseignant->Adresse; ?></td>
                            <td><?php echo $enseignant->Mail; ?></td>
                            <td><?php echo $enseignant->Tel; ?></td>
                            <td><?php echo $enseignant->CodeDepartement; ?></td>
                            <td><?php echo $enseignant->CodeGrade; ?></td>

                            <td> 
                                <a href="modifierenseignant.php?id=<?php echo $enseignant->CodeEnseignant; ?>" class="btn btn-success">Modifier</a>
                                <a href="supprimerenseignant.php?id=<?php echo $enseignant->CodeEnseignant; ?>" class="btn btn-danger mt-4">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun enseignant trouvé.</p>
        <?php } ?>
    </div>

    <!-- Add Bootstrap JS and your custom JavaScript if needed -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Add custom JavaScript code if needed
    </script>
</body>
</html>
