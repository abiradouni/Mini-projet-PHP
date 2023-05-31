<?php
require_once 'config.php';
require_once 'enseignant.php';


$codeEnseignant = $nom = $prenom = $dateRecrutement = $adresse = $mail = $tel = $CodeDepartement = $CodeGrade = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $codeEnseignant = $_POST['code_enseignant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateRecrutement = $_POST['date_recrutement'];
    $adresse = $_POST['adresse'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $codeDepartement = $_POST['code_departement'];
    $codeGrade = $_POST['code_grade'];
    

 
    $enseignant = new Enseignant($codeEnseignant,$nom,$prenom,$dateRecrutement,$adresse,$mail,$tel,$codeDepartement,$codeGrade);

    $enseignant->create();

    header('Location: listeenseignant.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Enseignant</title>
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
        <h1 class="my-4">Ajouter Enseignant</h1>
        <?php if ($error) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="code_enseignant">Code Enseignant:</label>
                <input type="text" class="form-control" name="code_enseignant" id="code_enseignant" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" name="nom" id="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prenom:</label>
                <input type="text" class="form-control" name="prenom" id="prenom" required>
            </div>

            <div class="form-group">
                <label for="date_recrutement">Date Recrutement:</label>
                <input type="date" class="form-control" name="date_recrutement" id="date_recrutement" required>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" class="form-control" name="adresse" id="adresse" required>
            </div>

            <div class="form-group">
                <label for="mail">Mail:</label>
                <input type="email" class="form-control" name="mail" id="mail" required>
            </div>

            <div class="form-group">
                <label for="tel">Tel:</label>
                <input type="tel" class="form-control" name="tel" id="tel" required>
            </div>

            <div class="form-group">
                <label for="code_departement">Code Departement:</label>
                <input type="text" class="form-control" name="code_departement" id="code_departement" required>
            </div>

            <div class="form-group">
                <label for="code_grade">Code Grade:</label>
                <input type="text" class="form-control" name="code_grade" id="code_grade" required>
            </div>

            <button type="submit" class="btn btn-info">Ajouter</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
