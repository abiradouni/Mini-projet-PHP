<?php
require_once 'config.php';
require_once 'etudiant.php';


$codeEtudiant = $nom = $prenom = $dateNaissance = $codeClasse = $numInscription = $adresse = $mail = $tel = '';
$error = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $codeEtudiant = $_POST['code_etudiant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $dateNaissance = $_POST['date_naissance'];
    $codeClasse = $_POST['code_classe'];
    $numInscription = $_POST['num_inscription'];
    $adresse = $_POST['adresse'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];


    $etudiant = new Etudiant($codeEtudiant, $nom, $prenom, $dateNaissance, $codeClasse, $numInscription, $adresse, $mail, $tel);

  
    $etudiant->create();


    header('Location: listeetudiant.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Etudiant</title>
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
        <h1 class="my-4">Ajouter Etudiant</h1>
        <?php if ($error) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="code_etudiant">Code Etudiant:</label>
                <input type="text" class="form-control" name="code_etudiant" id="code_etudiant" required>
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
                <label for="date_naissance">Date Naissance:</label>
                <input type="date" class="form-control" name="date_naissance" id="date_naissance" required>
            </div>

            <div class="form-group">
                <label for="code_classe">Code Classe:</label>
                <input type="text" class="form-control" name="code_classe" id="code_classe" required>
            </div>

            <div class="form-group">
                <label for="num_inscription">Num Inscription:</label>
                <input type="text" class="form-control" name="num_inscription" id="num_inscription" required>
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

            <button type="submit" class="btn btn-info">Ajouter</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
