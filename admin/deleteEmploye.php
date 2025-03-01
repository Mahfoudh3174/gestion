<?php
session_start();
if(!isset($_SESSION['admin']) || !isset($_GET['id'])){
    header("Location: http://localhost/gestion/login.php");
    exit;
}
require __DIR__ . '/../db/emloyees.php';

// Get the employee ID from the URL parameter
$employe_id = $_GET['id'];

// Create an instance of the Employe class
$employe = new ManageEmploye();

// Call the deleteEmploye method
if ($employe->deleteEmploye($employe_id)) {
    // Employee deleted successfully
    $_SESSION['success'] = "Employé supprimé avec succès.";
    
    header("Location: http://localhost/gestion/admin/dashboard.php");
    
} else {
    // Error deleting employee
    $_SESSION['error'] = "Une erreur s'est produite lors de la suppression de l'employé.";
    
    header("Location: http://localhost/gestion/admin/dashboard.php");
    
}