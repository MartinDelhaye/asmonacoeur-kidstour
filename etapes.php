<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Etapes.php');

include_once('Composant/templateListeEtapes.php');

// Récupération des invités depuis la base de données
$tab = Etapes::getListeEtapes(); // Méthode qui retourne un tableau d'étapes
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Etapes</title>
</head>

<body>
    <?php include('Composant/Header.php'); ?>
    <main>
    <article>
        <h1 class="text-danger fw-bold d-flex justify-content-center align-items-center text-center">Les étapes</h1>
    <div data-api="API/recupListeEtapes.php" id="formListeFiltreOrdre">  
    <label for="ordre">Ordre : </Label>
    <select id="ordre">
        <option value="date_etape ASC, heure_etape ASC">Date (ascendant)</option>
        <option value="date_etape DESC, heure_etape DESC">Date (descendant)</option>
        <option value="nom_etape ASC">Nom (A -> Z)</option>
        <option value="nom_etape DESC">Nom (Z -> A)</option>
    </select>

    <label for="filtre">Filtre : </label>
    <select id="filtre">
        <option value="nom_etape" data-type="text">Nom</option>
        <option value="date_etape" data-type="date">Date</option>
</select>
    <label for="filtreValeur">Valeur : </label>
    <input type="text" id="filtreValeur" placeholder="Entrez une valeur">
</div>
<div id="listeInfo" data-template="templateListeEtapes"></div>
</article>
        
   
    <?php
    include 'Composant/scrollTopBtn.php';
    include 'Composant/Footer.php';
    ?>
</body>

</html>