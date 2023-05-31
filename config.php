
<?php
define('db_host', 'localhost');
define('db_user', 'root');
define('db_password', '');
define('db_database', 'base');

$link = mysqli_connect(db_host, db_user, db_password, db_database);

// Vérifier la connexion
if (!$link) {
  die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
}
?>
