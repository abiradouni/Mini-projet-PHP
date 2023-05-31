<?php
require_once 'config.php';
require_once 'etudiant.php';

// Vérifier si l'ID de l'étudiant est spécifié dans l'URL
if (isset($_GET['id'])) {
    // Récupérer l'ID de l'étudiant à supprimer
    $id = $_GET['id'];

    // Créer une instance de la classe Etudiant
    $etudiant = new Etudiant($id,'','','','','','','','');

    // Supprimer l'étudiant
    $etudiant->delete() ;
        // Rediriger vers la page de succès ou afficher un message de succès
        header('Location: listeetudiant.php');
        exit();
    } 