<?php
require_once 'config.php';

class Etudiant {
    public $CodeEtudiant;
    public $Nom;
    public $Prenom;
    public $DateNaissance;
    public $CodeClasse;
    public $NumInscription;
    public $Adresse;
    public $Mail;
    public $Tel;
    
    // Constructeur
    public function __construct($codeEtudiant, $nom, $prenom, $dateNaissance, $codeClasse, $numInscription, $adresse, $mail, $tel) {
        $this->CodeEtudiant = $codeEtudiant;
        $this->Nom = $nom;
        $this->Prenom = $prenom;
        $this->DateNaissance = $dateNaissance;
        $this->CodeClasse = $codeClasse;
        $this->NumInscription = $numInscription;
        $this->Adresse = $adresse;
        $this->Mail = $mail;
        $this->Tel = $tel;
    }
    
     // Create a new student
     public function create() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        $req = $mysqli->prepare("INSERT INTO etudiant (CodeEtudiant, Nom, Prenom, DateNaissance, CodeClasse, NumInscription, Adresse, Mail, Tel) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $req->bind_param('sssssssss', $this->CodeEtudiant, $this->Nom, $this->Prenom, $this->DateNaissance, $this->CodeClasse, $this->NumInscription, $this->Adresse, $this->Mail, $this->Tel);
        $req->execute();
        $req ->close();
    }

     // Read student by code
     public static function read($codeEtudiant) {
        $query = "SELECT * FROM etudiant WHERE CodeEtudiant = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $codeEtudiant);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return new Etudiant(
            $row['CodeEtudiant'],
            $row['Nom'],
            $row['Prenom'],
            $row['DateNaissance'],
            $row['CodeClasse'],
            $row['NumInscription'],
            $row['Adresse'],
            $row['Mail'],
            $row['Tel']
        );
    }

     // Update student
     public function update() {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
    
        $query = "UPDATE etudiant 
                  SET Nom = ?, Prenom = ?, DateNaissance = ?, CodeClasse = ?, NumInscription = ?, Adresse = ?, Mail = ?, Tel = ?
                  WHERE CodeEtudiant = ?";
    
        $stmt = $mysqli->prepare($query);
        
        if ($stmt) {
            $stmt->bind_param('sssssssss', $this->Nom, $this->Prenom, $this->DateNaissance, $this->CodeClasse, $this->NumInscription, $this->Adresse, $this->Mail, $this->Tel, $this->CodeEtudiant);
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

        $stmt = $mysqli->prepare("DELETE FROM etudiant WHERE CodeEtudiant = ?");
        $stmt->bind_param('s', $this->CodeEtudiant);
        $stmt->execute();
        
        
        $stmt->close();
        $mysqli->close();
        }
    
    
    public static function getEtudiantById($id) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        
        // Vérifier la connexion à la base de données
        if ($mysqli->connect_errno) {
            echo "Échec de la connexion à la base de données : " . $mysqli->connect_error;
            exit();
        }
        
        $req = $mysqli->prepare("SELECT CodeEtudiant, Nom, Prenom, DateNaissance, CodeClasse, NumInscription, Adresse, Mail, Tel FROM etudiant WHERE CodeEtudiant = ?");
        
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
            return new Etudiant($row['CodeEtudiant'], $row['Nom'], $row['Prenom'], $row['DateNaissance'], $row['CodeClasse'], $row['NumInscription'], $row['Adresse'], $row['Mail'], $row['Tel']);
        }
        
        return null;
    }
    
    
    
    public static function getListeEtudiants() {
        require_once('config.php');
        
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
        $query = "SELECT * FROM etudiant";
        
        $result = $mysqli->query($query);
        $etudiants = array();
        
        while ($row = $result->fetch_assoc()) {
            $etudiant = new Etudiant(
                $row['CodeEtudiant'],
                $row['Nom'],
                $row['Prenom'],
                $row['DateNaissance'],
                $row['CodeClasse'],
                $row['NumInscription'],
                $row['Adresse'],
                $row['Mail'],
                $row['Tel']
            );
            
            $etudiants[] = $etudiant;
        }
        
        $mysqli->close();
        
        return $etudiants;
    }
    


}
?>