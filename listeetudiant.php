<?php
require_once 'config.php';
require_once 'etudiant.php';

// Créer une instance de la classe Etudiant
$etudiants = Etudiant::getListeEtudiants();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des étudiants</title>
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
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <h1>Liste des étudiants</h1>
        <?php if (count($etudiants) > 0) { ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <!--th>Code Étudiant</!th-->
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Date de Naissance</th>
                        <th>Code Classe</th>
                        <th>N°Inscription</th>
                        <th>Adresse</th>
                        <th>Mail</th>
                        <th>Tel</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etudiants as $etudiant) { ?>
                        <tr>
                            <!--td><?php echo $etudiant->CodeEtudiant; ?></td-->
                            <td><?php echo $etudiant->Nom; ?></td>
                            <td><?php echo $etudiant->Prenom; ?></td>
                            <td><?php echo $etudiant->DateNaissance; ?></td>
                            <td><?php echo $etudiant->CodeClasse; ?></td>
                            <td><?php echo $etudiant->NumInscription; ?></td>
                            <td><?php echo $etudiant->Adresse; ?></td>
                            <td><?php echo $etudiant->Mail; ?></td>
                            <td><?php echo $etudiant->Tel; ?></td>
                            <td>
                                <a href="modifieretudiant.php?id=<?php echo $etudiant->CodeEtudiant; ?>" class="btn btn-success">Modifier</a>
                                <a href="supprimeretudiant.php?id=<?php echo $etudiant->CodeEtudiant; ?>" class="btn btn-danger mt-4">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun étudiant trouvé.</p>
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
