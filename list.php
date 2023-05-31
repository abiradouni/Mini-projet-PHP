<?php
    //
    require_once 'config.php';
    require_once 'stat.php';
    $Nom = $_POST['NomEtudiant'];
    $Prenom = $_POST['PrenomEtudiant'];
    $DateDebut = date("Y-m-d", strtotime($_POST['DateDebut']));
    $DateFin = date("Y-m-d", strtotime($_POST['DateFin']));
    $NomClasse = $_POST['NomClasse'];
    //
    $stat = new Stat($link);
    $subjects = $stat->Liste_absence_etudiant($Nom, $Prenom, $DateDebut, $DateFin, $NomClasse) ;
    ?>
    <html>
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
      
        <table class="table">
          <thead>
            <tr>
              <th>Matiere</th>
              <th>nombre absences</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($subjects as $subject) { ?>
              <tr>
                <td><?php echo $subject['NomMatiere'] ; ?></td>
                <td><?php echo $subject['nb_absences']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table> 
    </body>
    </html>

    