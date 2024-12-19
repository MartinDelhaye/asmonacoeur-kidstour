<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Invites.php');
include_once('Composant/templateListeInvites.php');
// Récupération des invités depuis la base de données
$tab = Invites::getListeInvites(); // Méthode qui retourne un tableau d'invités
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Invités</title>
</head>

<body>
    <?php include('Composant/Header.php'); ?>
    <main>
    <article>
        <h1 class="text-danger fw-bold d-flex justify-content-center align-items-center text-center">Les invités</h1>
    <div data-api="API/recupListeInvites.php" id="formListeFiltreOrdre">  
    <label for="ordre">Ordre : </Label>
    <select id="ordre">
        <option value="nom_invite ASC">Nom (A -> Z)</option>
        <option value="nom_invite DESC">Nom (Z -> A)</option>
        <option value="prenom_invite ASC">Nom (A -> Z)</option>
        <option value="prenom_invite DESC">Nom (Z -> A)</option>
    </select>

    <label for="filtre">Filtre : </label>
    <select id="filtre">
        <option value="nom_invite" data-type="text">Nom</option>
        <option value="prenom_invite" data-type="text">Prénom</option>
</select>
    <label for="filtreValeur">Valeur : </label>
    <input type="text" id="filtreValeur" placeholder="Entrez une valeur">
</div>
<div id="listeInfo" data-template="templateListeInvites"></div>
</article>
    </main>
    <?php
    include 'Composant/scrollTopBtn.php';
    include 'Composant/Footer.php';
    ?>
</body>

</html>