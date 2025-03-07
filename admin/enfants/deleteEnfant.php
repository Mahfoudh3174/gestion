<?php
session_start();
if(!isset($_GET['id'])){
    header("Location: http://localhost/gestion/admin/dashboard.php");
    exit;
}
require __DIR__ . '/../../db/enfants.php';

// Get the employee ID from the URL parameter
$enfant_id = $_GET['id'];

// Create an instance of the Employe class
$employe = new ManageEnfant();

// Call the deleteEmploye method
if ($employe->deleteEnfant($enfant_id)) {
    // Employee deleted successfully
    $_SESSION['success'] = "Enfant supprimé avec succès.";
    
    header("Location: http://localhost/gestion/admin/enfants/enfants.php");
    
} else {
    // Error deleting employee
    $_SESSION['error'] = "Une erreur s'est produite lors de la suppression de l'enfant.";
    
    header("Location: http://localhost/gestion/admin/enfants/enfants.php");
    
}