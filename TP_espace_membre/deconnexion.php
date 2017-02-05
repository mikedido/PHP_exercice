<?php
//destruction de la connexion
session_start();
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();

//redirection vers la page de connexion
header('location:connexion.php');

?>
