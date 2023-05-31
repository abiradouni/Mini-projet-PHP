<?php
require_once 'config.php';
require_once 'matiere.php';

// Vérifier si l'ID de la matière est spécifié dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de la matière depuis l'URL
    $id = $_GET['id'];

    // Vérifier si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $CodeMatiere = $_POST['code_matiere'];
        $NomMatiere = $_POST['nom'];
        $NbreHeureCourseParSemaine = $_POST['nbc'];
        $NbreHeureTDParSemaine = $_POST['nbtd'];
        $NbreHeureTPParSemaine = $_POST['nbtp'];

        // Créer une instance de la classe Matiere
        $matiere = new Matiere($CodeMatiere, $NomMatiere, $NbreHeureCourseParSemaine, $NbreHeureTDParSemaine, $NbreHeureTPParSemaine);

        // Mettre à jour la matière
        if ($matiere->update()) {
            // Rediriger vers la liste des matières
            header('Location: listematiere.php');
            exit();
        } else {
            $error = 'Failed to update the matiere. Please try again.';
        }
    } else {
        // Récupérer les informations de la matière à partir de la base de données
        $matiere = Matiere::getMatiereById($id);

        if (!$matiere) {
            // La matière n'existe pas, rediriger vers la liste des matières
            header('Location: listematiere.php');
            exit();
        }

        // Pré-remplir le formulaire avec les informations de la matière
        $CodeMatiere = $matiere->CodeMatiere;
        $NomMatiere = $matiere->NomMatiere;
        $NbreHeureCourseParSemaine = $matiere->NbreHeureCourseParSemaine;
        $NbreHeureTDParSemaine = $matiere->NbreHeureTDParSemaine;
        $NbreHeureTPParSemaine = $matiere->NbreHeureTPParSemaine;
    }
} else {
    // L'ID de la matière n'est pas spécifié, rediriger vers la liste des matières
    header('Location: listematiere.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une matiere</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Modifier une matiere</h1>
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="code_matiere">Code Matiere:</label>
                <input type="text" class="form-control" name="code_matiere" id="code_matiere" value="<?php echo $CodeMatiere; ?>" required>
            </div>

            <div class="form-group">
                <label for="nom">Nom Matiere:</label>
                <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $NomMatiere; ?>" required>
            </div>

            <div class="form-group">
                <label for="nbc">Nombre d'heures de cours par semaine:</label>
                <input type="text" class="form-control" name="nbc" id="nbc" value="<?php echo $NbreHeureCourseParSemaine; ?>" required>
            </div>

            <div class="form-group">
                <label for="nbtd">Nombre d'heures de TD par semaine:</label>
                <input type="text" class="form-control" name="nbtd" id="nbtd" value="<?php echo $NbreHeureTDParSemaine; ?>" required>
            </div>

            <div class="form-group">
                <label for="nbtp">Nombre d'heures de TP par semaine:</label>
                <input type="text" class="form-control" name="nbtp" id="nbtp" value="<?php echo $NbreHeureTPParSemaine; ?>" required>
            </div>

            <button type="submit" class="btn btn-info">Modifier</button>
        </form>
    </div>

  
</body>
</html>

