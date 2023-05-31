<?php
require_once 'config.php';
require_once 'etudiant.php';

// Vérifier si l'ID de l'étudiant est spécifié dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'étudiant depuis l'URL
    $id = $_GET['id'];

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $codeEtudiant = $_POST['code_etudiant'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateNaissance = $_POST['date_naissance'];
        $codeClasse = $_POST['code_classe'];
        $numInscription = $_POST['num_inscription'];
        $adresse = $_POST['adresse'];
        $mail = $_POST['mail'];
        $tel = $_POST['tel'];

        // Créer une instance de la classe Etudiant
        $etudiant = new Etudiant($codeEtudiant, $nom, $prenom, $dateNaissance, $codeClasse, $numInscription, $adresse, $mail, $tel);

        // Mettre à jour l'étudiant
        if ($etudiant->update($id)) {
            // Rediriger vers la liste des étudiants
            header('Location: listeetudiant.php');
            exit();
        } else {
            $error = 'Failed to update the student. Please try again.';
        }
    } else {
        // Récupérer les informations de l'étudiant à partir de la base de données
        $etudiant = Etudiant::getEtudiantById($id);

        if (!$etudiant) {
            // L'étudiant n'existe pas, rediriger vers la liste des étudiants
            header('Location: listeetudiant.php');
            exit();
        }

        // Pré-remplir le formulaire avec les informations de l'étudiant
        $codeEtudiant = $etudiant->CodeEtudiant;
        $nom = $etudiant->Nom;
        $prenom = $etudiant->Prenom;
        $dateNaissance = $etudiant->DateNaissance;
        $codeClasse = $etudiant->CodeClasse;
        $numInscription = $etudiant->NumInscription;
        $adresse = $etudiant->Adresse;
        $mail = $etudiant->Mail;
        $tel = $etudiant->Tel;
    }
} else {
    // L'ID de l'étudiant n'est pas spécifié, rediriger vers la liste des étudiants
    header('Location: listeetudiant.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un etudiant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Modifier un etudiant</h1>
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="code_etudiant">Code Etudiant:</label>
                <input type="text" class="form-control" name="code_etudiant" id="code_etudiant" value="<?php echo $codeEtudiant; ?>" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nom; ?>" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prenom:</label>
                <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenom; ?>" required>
            </div>

            <div class="form-group">
                <label for="date_naissance">Date Naissance:</label>
                <input type="date" class="form-control" name="date_naissance" id="date_naissance" value="<?php echo $dateNaissance; ?>" required>
            </div>

            <div class="form-group">
                <label for="code_classe">Code Classe:</label>
                <input type="text" class="form-control" name="code_classe" id="code_classe" value="<?php echo $codeClasse; ?>" required>
            </div>

            <div class="form-group">
                <label for="num_inscription">Num Inscription:</label>
                <input type="text" class="form-control" name="num_inscription" id="num_inscription" value="<?php echo $numInscription; ?>" required>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse:</label>
                <input type="text" class="form-control" name="adresse" id="adresse" value="<?php echo $adresse; ?>" required>
            </div>

            <div class="form-group">
                <label for="mail">Mail:</label>
                <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $mail; ?>" required>
            </div>

            <div class="form-group">
                <label for="tel">Tel:</label>
                <input type="tel" class="form-control" name="tel" id="tel" value="<?php echo $tel; ?>" required>
            </div>

            <button type="submit" class="btn btn-info">Modifier</button>
        </form>
    </div>

   
</body>
</html>

