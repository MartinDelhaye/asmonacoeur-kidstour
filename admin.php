<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');


if (isUserLoggedIn())
    $user = $_SESSION['compte'];

if (!($user instanceof MembreAssociation)) {
    header('Location: index.php');
    exit();
}

include_once('Composant/templateFormSupprimerInvites.php');
include_once('Composant/templateFormSupprimerEtapes.php');

include_once('Composant/templateFormModifInvites.php');
include_once('Composant/templateFormModifEtapes.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <title>Admin</title>
</head>

<body>
    <?php include 'Composant/Header.php' ?>
    <main>
        <h1>Page d'administration</h1>
        <?php if (isset($_SESSION['message_error'])): ?>
            <p> <?php echo $_SESSION['message_error'] ?> </p>
            <?php
            unset($_SESSION['message_error']);
        endif;
        ?>
        <?php if (isset($_SESSION['message_success'])): ?>
            <p> <?php echo $_SESSION['message_success'] ?> </p>
            <?php
            unset($_SESSION['message_success']);
        endif;
        ?>


        <article>
            <h2> Suppression : </h2>
            <section>
                <h3> Supprimer un invité : </h3>
                <div data-api="API/recupListeInvites.php" class="formListeFiltreOrdre">
                <?php include_once('Composant/SelectInvites.php')?>   
                <div class="listeInfo" data-template="templateFormSupprimerInvites"></div>
                </div>

            </section>
            <section>
                <h3> Supprimer une Etape : </h3>
                <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
                <?php include_once('Composant/SelectEtapes.php')?>
                <div class="listeInfo" data-template="templateFormSupprimerEtapes"></div>
                </div>
            </section>
        </article>
        <article>
            <h2> Modification : </h2>
            <section>
                <h3> Modifier un invité : </h3>
                <div data-api="API/recupListeInvites.php" class="formListeFiltreOrdre">
                <?php include_once('Composant/SelectInvites.php')?>   
                <div class="listeInfo" data-template="templateFormModifInvites"></div>
                </div>

            </section>
            <section>
                <h3> Modifier une Etape : </h3>
                <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
                <?php include_once('Composant/SelectEtapes.php')?> 
                <div class="listeInfo" data-template="templateFormModifEtapes"></div>
                </div>
            </section>
        </article>
    </main>
    <?php include 'Composant/Footer.php' ?>
</body>

</html>