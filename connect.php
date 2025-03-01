<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "gestion"; 

// Connexion à MySQL
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérifier la connexion
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

?>
