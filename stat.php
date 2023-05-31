<?php
require_once 'config.php';

class Stat {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

   

    public function Liste_absence_etudiant($Nom, $Prenom, $DateDebut, $DateFin, $NomClasse) {
        $query = "SELECT NomMatiere, COUNT(*) AS nb_absences
                  FROM etudiant e
                  INNER JOIN ligneficheabsence lf ON lf.CodeEtudiant = e.CodeEtudiant
                  INNER JOIN ficheAbsence f ON f.CodeFicheAbsence = lf.CodeFicheAbsence
                  INNER JOIN matiere m ON m.CodeMatiere = f.CodeMatiere
                  INNER JOIN classe c ON c.CodeClasse = e.CodeClasse
                  WHERE e.Nom = ?
                    AND e.Prenom = ?
                    AND c.NomClasse = ?
                    AND f.DateJour BETWEEN ? AND ?
                  GROUP BY m.NomMatiere";
    
        $stmt = $this->db->prepare($query); 
        $stmt->bind_param('sssss', $Nom, $Prenom, $NomClasse, $DateDebut, $DateFin);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            die('Error in executing the query: ' . $stmt->error);
        }
        
        $stmt->close();
        
        return $rows;
    }
    
    public function Liste_absence_etudiant_parMatiere($CodeEtudiant, $CodeMatiere, $DateDebut, $DateFin) {
        require_once('config.php');
        $mysqli = new mysqli(db_host, db_user, db_password, db_database);
    
        if ($mysqli->connect_errno) {
            printf("Échec de la connexion : %s\n", $mysqli->connect_error);
            exit();
        }
    
        $stmt = $mysqli->prepare("
            SELECT enseignant.nom, ficheabsence.datejour, seance.nomseance
            FROM ficheabsence
            JOIN ligneficheabsence ON ficheabsence.codeFicheAbsence = ligneficheabsence.codeficheabsence
            JOIN matiere ON ficheabsence.codematiere = matiere.codematiere
            JOIN enseignant ON ficheabsence.codeenseignant = enseignant.codeenseignant
            JOIN ficheabsenceseance ON ficheabsence.codeFicheAbsence = ficheabsenceseance.codeficheabsence
            JOIN seance ON seance.codeseance = ficheabsenceseance.codeseance
            WHERE ligneficheabsence.codeetudiant = ?
              AND matiere.codematiere = ?
              AND ficheabsence.datejour BETWEEN ? AND ?
        ");
    
        if (!$stmt) {
            printf("Échec de la préparation de la requête : %s\n", $mysqli->error);
            exit();
        }
    
        $stmt->bind_param("ssss", $CodeEtudiant, $CodeMatiere, $DateDebut, $DateFin);
        $stmt->execute();
        $results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        $mysqli->close();
        return $results;
    }    
    
}    
                          

?>
