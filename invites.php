<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Invites.php');
include_once('Composant/templateListeInvites.php');
if(isUserLoggedIn()) $user = $_SESSION['compte'];
// Récupération des invités depuis la base de données
$tab = Invites::getListeInvites(); // Méthode qui retourne un tableau d'invités
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="liste invités KidsTour AS Monacoeur">
    <meta name="description" content="Page de la liste des invités du Kids Tour organisé par l'AS Monaco">
    <title>Invités</title>
</head>

<body>
    <?php include('Composant/Header.php'); ?>
    <main>
    <article>
        <h1 class="text-danger fw-bold d-flex justify-content-center align-items-center text-center mt-5">Les invités</h1>
    <div data-api="API/recupListeInvites.php" class="formListeFiltreOrdre">  
    <?php include('Composant/SelectInvites.php')?>
    <div class="listeInfo" data-template="templateListeInvites"></div>
</article>
    </main>
    <?php
    include 'Composant/scrollTopBtn.php';
    include 'Composant/Footer.php';
    ?>
</body>

</html>