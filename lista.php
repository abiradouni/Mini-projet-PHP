<?php
require_once('config.php');
require_once('stat.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $CodeEtudiant = $_POST['code_etudiant'];
  $CodeMatiere = $_POST['code_matiere'];
  $DateDebut = $_POST['date_D'];
  $DateFin = $_POST['date_F'];

  $stat = new Stat($link);
  $absences = $stat->Liste_absence_etudiant_parMatiere($CodeEtudiant, $CodeMatiere, $DateDebut, $DateFin);
  $NomMatiere_query = mysqli_query($link, "SELECT NomMatiere FROM matiere WHERE CodeMatiere = '$CodeMatiere'");
  $NomMatiere_row = mysqli_fetch_assoc($NomMatiere_query);
  $NomMatiere = $NomMatiere_row['NomMatiere'];
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Rapport d'absence pour l'etudiant <?php echo $CodeEtudiant; ?> en <?php echo $CodeMatiere; ?></title>
    <!-- Ajout des fichiers CSS de Bootstrap -->
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
    <h2 class="mt-4">Matiere  <?php echo $NomMatiere; ?></h2>

      <?php if (is_countable($absences) && count($absences) > 0) { ?>
        <table class="table">
          <thead>
            <tr>
              <th>Date Du Jour</th>
              <th>Enseignant</th>
              <th>Séance</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($absences as $absence) { ?>
              <tr>
                <td><?php echo $absence['datejour']; ?></td>
                <td><?php echo $absence['nom'] ; ?></td>
                <td><?php echo $absence['nomseance']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <p>Nombre d'absences : <?php echo count($absences); ?></p>

      <?php } else { ?>
        <p>Aucune donnée trouvee pour la recherche.</p>
      <?php } ?>
      
    </div>

    <!-- Ajout des fichiers JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
  </html>
  
<?php } ?>