<?php
require_once 'config.php';
require_once 'matiere.php';


$CodeMatiere = $NomMatiere = $NbreHeureCourseParSemaine = $NbreHeureTDParSemaine = $NbreHeureTPParSemaine = '';
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $CodeMatiere = $_POST['code_matiere'];
    $NomMatiere = $_POST['nom'];
    $NbreHeureCourseParSemaine = $_POST['nbc'];
    $NbreHeureTDParSemaine = $_POST['nbtd'];
    $NbreHeureTPParSemaine = $_POST['nbtp'];

    
    $matiere = new Matiere($CodeMatiere, $NomMatiere, $NbreHeureCourseParSemaine, $NbreHeureTDParSemaine, $NbreHeureTPParSemaine);

   
    $matiere->create();

    
    header('Location: listematiere.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Matiere</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <h1 class="my-4">Ajouter Matiere</h1>
        <?php if ($error) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="code_matiere">Code Matiere:</label>
                <input type="text" class="form-control" name="code_matiere" id="code_matiere" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom Matiere:</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>

            <div class="form-group">
                <label for="nbc">Nombre Heures Cours Par Semaine:</label>
                <input type="number" class="form-control" name="nbc" id="nbc" required>
            </div>

            <div class="form-group">
                <label for="nbtd">Nombre Heure TD Par Semaine:</label>
                <input type="number" class="form-control" name="nbtd" id="nbtd" required>
            </div>

            <div class="form-group">
                <label for="nbtp">Nombre Heure TP Par Semaine:</label>
                <input type="number" class="form-control" name="nbtp" id="nbtp" required>
            </div>

            <button type="submit" class="btn btn-info">Ajouter</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
