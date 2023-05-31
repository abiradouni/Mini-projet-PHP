<!DOCTYPE html>
<html>
<head>
    <title>Search Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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



    <div class="container mt-4">
        
        <form action="list.php" method="POST">
            <div class="form-group">
                <label for="dateDebut">Date Debut:</label>
                <input type="date" id="DateDebut" name="DateDebut" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="dateFin">Date Fin:</label>
                <input type="date" id="DateFin" name="DateFin" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="NomEtudiant" name="NomEtudiant" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="prenom">Prenom:</label>
                <input type="text" id="PrenomEtudiant" name="PrenomEtudiant" class="form-control" required>
            </div>
        
            <div class="form-group">
                <label for="classe">Classe:</label>
                <select id="NomClasse" name="NomClasse" class="form-control" required>
                  
                    <?php
                    require_once('config.php');
                    $mysqli = new mysqli(db_host, db_user, db_password, db_database);
                    $query = "SELECT NomClasse FROM classe ORDER BY NomClasse";
                    $result = $mysqli->query($query);
                    while ($row = $result->FETCH_ASSOC()) {
                        $NomClasse = $row['NomClasse'];
                        echo "<option value='$NomClasse'> $NomClasse </option>";
                    }
                    $mysqli->close();
                    ?>
                </select>
            </div>
        
            <input type="submit" value="Search" class="btn btn-info">
        </form>
    </div>

   
    
</body>
</html>




