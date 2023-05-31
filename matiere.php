
<?php

require_once 'config.php';

class Matiere {
    public $CodeMatiere;
    public $NomMatiere;
    public $NbreHeureCourseParSemaine;
    public $NbreHeureTDParSemaine;
    public $NbreHeureTPParSemaine;

    public function __construct($CodeMatiere, $NomMatiere, $NbreHeureCourseParSemaine, $NbreHeureTDParSemaine, $NbreHeureTPParSemaine) {
        $this->CodeMatiere = $CodeMatiere;
        $this->NomMatiere = $NomMatiere;
        $this->NbreHeureCourseParSemaine = $NbreHeureCourseParSemaine;
        $this->NbreHeureTDParSemaine = $NbreHeureTDParSemaine;
        $this->NbreHeureTPParSemaine = $NbreHeureTPParSemaine;
    }

     // Create a new matiere
     public function create() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        $req = $mysqli->prepare("INSERT INTO matiere (CodeMatiere, NomMatiere, NbreHeureCourseParSemaine, NbreHeureTDParSemaine,
         NbreHeureTPParSemaine) 
                  VALUES (?, ?, ?, ?, ?)");
        $req->bind_param('sssss', $this->CodeMatiere, $this->NomMatiere, $this->NbreHeureCourseParSemaine, $this->NbreHeureTDParSemaine,$this->NbreHeureTPParSemaine);
        $req->execute();
        $req ->close();
    }

     // Read student by code
     public static function read($CodeMatiere) {
        $query = "SELECT * FROM matiere WHERE CodeMatiere = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $CodeMatiere);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return new Matiere(
            $row['CodeMatiere'],
            $row['NomMatiere'],
            $row['NbreHeureCourseParSemaine'],
            $row['NbreHeureTDParSemaine'],
            $row['NbreHeureTPParSemaine'],
        );
    }

     // Update matiere
     public function update() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
    
        $query = "UPDATE matiere 
                  SET NomMatiere = ?, NbreHeureCourseParSemaine = ?, NbreHeureTDParSemaine = ?, NbreHeureTPParSemaine = ?
                  WHERE CodeMatiere = ?";
    
        $stmt = $mysqli->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('sssss', $this->NomMatiere, $this->NbreHeureCourseParSemaine, $this->NbreHeureTDParSemaine,
             $this->NbreHeureTPParSemaine, $this->CodeMatiere);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            return true;
        } else {
            $mysqli->close();
            return false;
        }
    }
    
    
    // Delete matiere
    public function delete() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);

        $stmt = $mysqli->prepare("DELETE FROM matiere WHERE CodeMatiere = ?");
        $stmt->bind_param('s', $this->CodeMatiere);
        $stmt->execute();
        
        
        $stmt->close();
        $mysqli->close();
        }
    
    
    public static function getMatiereById($id) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        
        // Vérifier la connexion à la base de données
        if ($mysqli->connect_errno) {
            echo "Échec de la connexion à la base de données : " . $mysqli->connect_error;
            exit();
        }
        
        $req = $mysqli->prepare("SELECT CodeMatiere, NomMatiere, NbreHeureCourseParSemaine, NbreHeureTDParSemaine, 
        NbreHeureTPParSemaine FROM matiere WHERE CodeMatiere = ?");
        
        // Vérifier la préparation de la requête
        if (!$req) {
            echo "Erreur de préparation de la requête : " . $mysqli->error;
            exit();
        }
        
        $req->bind_param('i', $id);
        $req->execute();
        $result = $req->get_result();
        $row = $result->fetch_assoc();
        $req->close();
        
        if ($row) {
            return new Matiere($row['CodeMatiere'], $row['NomMatiere'], $row['NbreHeureCourseParSemaine'], $row['NbreHeureTDParSemaine'],
             $row['NbreHeureTPParSemaine']);
        }
        
        return null;
    }
    
    
    
    public static function getListeMatieres() {
        require_once('config.php');
        
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        $query = "SELECT * FROM matiere";
        
        $result = $mysqli->query($query);
        $matieres = array();
        
        while ($row = $result->fetch_assoc()) {
            $matiere = new Matiere(
                $row['CodeMatiere'],
                $row['NomMatiere'],
                $row['NbreHeureCourseParSemaine'],
                $row['NbreHeureTDParSemaine'],
                $row['NbreHeureTPParSemaine'],
            );
            
            $matieres[] = $matiere;
        }
        
        $mysqli->close();
        
        return $matieres;
    }
    
}
?>

