<?php
session_start();
session_destroy();
header("Location: http://localhost/gestion/login.php"); 
exit;

?>