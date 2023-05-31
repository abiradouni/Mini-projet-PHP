<?php
require_once 'config.php';
require_once 'enseignant.php';

// Vérifier si l'ID de l'étudiant est spécifié dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'étudiant depuis l'URL
    $id = $_GET['id'];

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $codeEnseignant = $_POST['code_enseignant'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $dateRecrutement = $_POST['date_recrutement'];
        $adresse = $_POST['adresse'];
        $mail = $_POST['mail'];
        $tel = $_POST['tel'];
        $codeDepartement = $_POST['code_departement'];
        $codeGrade = $_POST['code_grade'];

        // Créer une instance de la classe Etudiant
        $enseignant = new Enseignant($codeEnseignant, $nom, $prenom, $dateRecrutement, $adresse, $mail, $tel, $codeDepartement, $codeGrade);

        // Mettre à jour l'étudiant
        if ($enseignant->update($id)) {
            // Rediriger vers la liste des étudiants
            header('Location: listeenseignant.php');
            exit();
        } else {
            $error = 'Failed to update enseignant. Please try again.';
        }
    } else {
        // Récupérer les informations de l'étudiant à partir de la base de données
        $enseignant = Enseignant::getEnseignantById($id);

        if (!$enseignant) {
            // L'étudiant n'existe pas, rediriger vers la liste des étudiants
            header('Location: listeenseignant.php');
            exit();
        }

        // Pré-remplir le formulaire avec les informations de l'étudiant
        $codeEnseignant = $enseignant->CodeEnseignant;
        $nom = $enseignant->Nom;
        $prenom = $enseignant->Prenom;
        $dateRecrutement = $enseignant->DateRecrutement;
        $adresse = $enseignant->Adresse;
        $mail = $enseignant->Mail;
        $tel = $enseignant->Tel;
        $codeDepartement = $enseignant->CodeDepartement;
        $codeGrade = $enseignant->CodeGrade;
    }
} else {
    // L'ID de l'étudiant n'est pas spécifié, rediriger vers la liste des étudiants
    header('Location: listeenseignant.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier un enseignant</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Modifier un enseignant</h1>
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="code_enseignant">Code Enseignant:</label>
                <input type="text" class="form-control" name="code_enseignant" id="code_enseignant" value="<?php echo $codeEnseignant; ?>" required>
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
                <label for="date_recrutement">Date Recrutement:</label>
                <input type="date" class="form-control" name="date_recrutement" id="date_recrutement" value="<?php echo $dateRecrutement; ?>" required>
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

            <div class="form-group">
                <label for="code_departement">Code Departement:</label>
                <input type="text" class="form-control" name="code_departement" id="code_departement" value="<?php echo $codeDepartement; ?>" required>
            </div>

            <div class="form-group">
                <label for="code_grade">Code Grade:</label>
                <input type="text" class="form-control" name="code_grade" id="code_grade" value="<?php echo $codeGrade; ?>" required>
            </div>

            <button type="submit" class="btn btn-info">Modifier</button>
        </form>
    </div>

    
</body>
</html>

