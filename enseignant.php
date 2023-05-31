<?php

require_once 'config.php';

class Enseignant {
    public $CodeEnseignant;
    public $Nom;
    public $Prenom;
    public $DateRecrutement;
    public $Adresse;
    public $Mail;
    public $Tel;
    public $CodeDepartement;
    public $CodeGrade;

    public function __construct($codeEnseignant, $nom, $prenom, $dateRecrutement, $adresse, $mail, $tel, $codeDepartement, $codeGrade) {
        $this->CodeEnseignant = $codeEnseignant;
        $this->Nom = $nom;
        $this->Prenom = $prenom;
        $this->DateRecrutement = $dateRecrutement;
        $this->Adresse = $adresse;
        $this->Mail = $mail;
        $this->Tel = $tel;

        $this->CodeDepartement = $codeDepartement;
        $this->CodeGrade = $codeGrade;
    }




     // Create
     public function create() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        $req = $mysqli->prepare("INSERT INTO enseignant (CodeEnseignant, Nom, Prenom, DateRecrutement,Adresse, Mail, Tel,CodeDepartement,CodeGrade) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $req->bind_param('sssssssss', $this->CodeEnseignant,
           $this->Nom, $this->Prenom, $this->DateRecrutement,
           $this->Adresse, $this->Mail, $this->Tel,
           $this->CodeDepartement, $this->CodeGrade,
        );
        $req->execute();
        $req ->close();
    }

     // Read by code
     public static function read($codeEnseignant) {
        $query = "SELECT * FROM enseignant WHERE CodeEnseignant = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $codeEnseignant);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return new Enseignant(
            $row['CodeEnseignant'],
            $row['Nom'],
            $row['Prenom'],
            $row['DateRecrutement'],
            $row['Adresse'],
            $row['Mail'],
            $row['Tel'],
            $row['CodeDepartement'],
            $row['CodeGrade'],
        );
    }

     // Update
     public function update() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
    
        $query = "UPDATE enseignant 
                  SET Nom = ?, Prenom = ?, DateRecrutement = ?,Adresse = ?, Mail = ?, Tel = ?, CodeDepartement = ?, CodeGrade = ?
                  WHERE CodeEnseignant = ?";
    
        $stmt = $mysqli->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('sssssssss', $this->Nom, $this->Prenom, $this->DateRecrutement,
            $this->Adresse, $this->Mail, $this->Tel,$this->CodeDepartement, $this->CodeGrade,
            $this->CodeEnseignant);
            $stmt->execute();
            $stmt->close();
            $mysqli->close();
            return true;
        } else {
            $mysqli->close();
            return false;
        }
    }

    
    
    
    // Delete student
    public function delete() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);

        $stmt = $mysqli->prepare("DELETE FROM enseignant WHERE CodeEnseignant = ?");
        $stmt->bind_param('s', $this->CodeEnseignant);
        $stmt->execute();
        
        
        $stmt->close();
        $mysqli->close();
        }
    
    
    public static function getEnseignantById($id) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        
        // Vérifier la connexion à la base de données
        if ($mysqli->connect_errno) {
            echo "Échec de la connexion à la base de données : " . $mysqli->connect_error;
            exit();
        }
        
        $req = $mysqli->prepare("SELECT CodeEnseignant, Nom, Prenom, DateRecrutement, Adresse, Mail, Tel ,CodeDepartement, CodeGrade 
        FROM enseignant WHERE CodeEnseignant = ?");
        
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
            return new Enseignant($row['CodeEnseignant'], $row['Nom'], $row['Prenom'], $row['DateRecrutement'],
            $row['Adresse'], $row['Mail'], $row['Tel'],
            $row['CodeDepartement'], $row['CodeGrade'], 
        );
        }
        
        return null;
    }
    
    
    
    public static function getListeEnseignants() {
        require_once('config.php');
        
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        $query = "SELECT * FROM enseignant";
        
        $result = $mysqli->query($query);
        $enseignants = array();
        
        while ($row = $result->fetch_assoc()) {
            $enseignant = new Enseignant(
                $row['CodeEnseignant'],
                $row['Nom'],
                $row['Prenom'],
                $row['DateRecrutement'],
                $row['Adresse'],
                $row['Mail'],
                $row['Tel'],
                $row['CodeDepartement'],
                $row['CodeGrade'],
            );
            
            $enseignants[] = $enseignant;
        }
        
        $mysqli->close();
        
        return $enseignants;
    }
    


}

    

?>
