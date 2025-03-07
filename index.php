<?php
if(isset($_SESSION['user']))
{
    header("Location: http://localhost/gestion/admin/dashboard.php");
    
}
else
{
    header("Location: http://localhost/gestion/login.php");
    exit;
}
?>