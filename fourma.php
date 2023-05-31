<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">

	<title>Liste d'absences pour un etudiant a une matiere donnee</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
		<h1 class="my-5">Liste d'absences pour un etudiant a une matiere donnee</h1>
		<form method="POST" action="lista.php">
			<div class="form-group">
				<label for="code_etudiant">Code de l'etudiant :</label>
				<input type="text" class="form-control" id="code_etudiant" name="code_etudiant" required>
			</div>
			<div class="form-group">
				<label for="code_matiere">Code de la matière :</label>
				<input type="text" class="form-control" id="code_matiere" name="code_matiere" required>
			</div>
			<div class="form-group">
				<label for="date_D">Date de début :</label>
				<input type="date" class="form-control" id="date_D" name="date_D" required>
			</div>
			<div class="form-group">
				<label for="date_F">Date de fin :</label>
				<input type="date" class="form-control" id="date_F" name="date_F" required>
			</div>
			<button type="submit" class="btn btn-info">Afficher la liste d'absences</button>
		</form>
	</div>
</body>
</html>