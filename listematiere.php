<?php
require_once 'config.php';
require_once 'matiere.php';

// Créer une instance de la classe Etudiant
$matieres = Matiere::getListeMatieres();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des matieres</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
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
        <h1>Liste des matieres</h1>
        <?php if (count($matieres) > 0) { ?>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <!--th>Code Matiere</th-->
                        <th>Nom Matiere</th>
                        <th>Heure Cours Par Semaine</th>
                        <th>Heure TD Par Semaine</th>
                        <th>Heure TP Par Semaine</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($matieres as $matiere) { ?>
                        <tr>
                            <!--td><?php echo $matiere->CodeMatiere; ?></td-->
                            <td><?php echo $matiere->NomMatiere; ?></td>
                            <td><?php echo $matiere->NbreHeureCourseParSemaine; ?></td>
                            <td><?php echo $matiere->NbreHeureTDParSemaine; ?></td>
                            <td><?php echo $matiere->NbreHeureTPParSemaine; ?></td>
                            <td>
                                <a href="modifiermatiere.php?id=<?php echo $matiere->CodeMatiere; ?>" class="btn btn-success">Modifier</a>
                                <a href="supprimermatiere.php?id=<?php echo $matiere->CodeMatiere; ?>" class="btn btn-danger mt-4">Supprimer</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucune matiere trouvée.</p>
        <?php } ?>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
