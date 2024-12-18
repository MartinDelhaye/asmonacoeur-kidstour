<?php
// pour se connecter à la base de données
include_once('../config/config.php');
include_once('../fonction/fonction.php');
include_once('../class/Users.php');
include_once('../class/Etapes.php');

$donnees = array();

//Récupère le filtre et/ou l'odre à appliquer aux données
if(isset($_GET["filtre"])) $filtre = $_GET["filtre"];
else $filtre = null;
if(isset($_GET["ordre"])) $ordre = $_GET["ordre"];
else $ordre = null;

$listeEtapes = Etapes::getListeEtapes($filtre, $ordre);

if(gettype($listeEtapes) == "array") {
    $donnees['status'] = "OK";
    $donnees['liste'] = $listeEtapes;
}
else $donnees['status'] = $listeEtapes;

// Encodage de la réponse en JSON et affichage
header('Content-Type: application/json');

$donneesJson = json_encode($donnees, JSON_HEX_APOS | JSON_UNESCAPED_UNICODE);
$donneesJson = str_replace("\\n", " ", $donneesJson);
echo $donneesJson;

?>