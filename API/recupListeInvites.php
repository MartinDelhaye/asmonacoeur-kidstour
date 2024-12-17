<?php
// pour se connecter à la base de données
include_once('../config/config.php');
include_once('../fonction/fonction.php');
include_once('../class/Invites.php');

if (!isUserLoggedIn()) header('Location: ../connexion.php');
else $user = $_SESSION['compte'];

$donnees = array();

//Récupère le filtre et/ou l'odre à appliquer aux données
if(isset($_GET["filtre"])) $filtre = $_GET["filtre"];
else $filtre = null;
if(isset($_GET["ordre"])) $ordre = $_GET["ordre"];
else $ordre = null;

Invites::getListeInvites($filtre, $ordre);

$donnees['listeInvites'] = $listeInvites;

if(count($listeInvites) >0) $donnees['status'] = "OK";
else $donnees['status'] = "Aucun invité trouvé";

// encodage au format JSON 
$donneesJson = json_encode($donnees, JSON_HEX_APOS);

// remplacement des \\n qui peuvent causer des erreurs en JavaScript 
$donneesJson = str_replace("\\n", " ", $donneesJson);

// on écrit les données 
echo $donneesJson;

?>