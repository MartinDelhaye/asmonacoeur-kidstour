<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

isUserLoggedIn();

print_r($_SESSION['compte']);


// Deconnexion (temporaire)
// $_SESSION['compte']->deconnexion();
// header('Location: connexion.php');

?>