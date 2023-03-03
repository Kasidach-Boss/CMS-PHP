<?php 
session_start();
session_destroy();
?>

<?php
//session_unset($_SESSION['username']);
//session_unset($_SESSION['firstname']);
//session_unset($_SESSION['lastname']);
//session_unset($_SESSION['user_role']);
$_SESSION['username'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;

header("Location: ../index.php");
die();
?> 