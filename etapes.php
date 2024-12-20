<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Etapes.php');

include_once('Composant/templateListeEtapes.php');
if(isUserLoggedIn()) $user = $_SESSION['compte'];

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
            <h1 class="text-danger fw-bold d-flex justify-content-center align-items-center text-center mt-5">Les étapes</h1>
            <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
            <?php include('Composant/SelectEtapes.php')?>
            <div class="listeInfo" data-template="templateListeEtapes"></div>
            </div>
        </article>


        <?php
        include 'Composant/scrollTopBtn.php';
        include 'Composant/Footer.php';
        ?>
</body>

</html>