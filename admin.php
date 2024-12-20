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

    <title>Admin</title>
</head>

<body>
    <?php include 'Composant/Header.php' ?>
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

    <main class="container my-5">
        <article>
            <h2 class="h4 mb-3 text-danger"> Suppression : </h2>
            <section class="mb-5">
                <h3 class="h4 mb-3"> Supprimer un invité : </h3>
                <div data-api="API/recupListeInvites.php" class="formListeFiltreOrdre">
                    <?php include('Composant/SelectInvites.php') ?>
                    <div class="listeInfo" data-template="templateFormSupprimerInvites"></div>
                </div>

            </section>
            <section class="mb-5">
                <h3 class="h4 mb-3"> Supprimer une Etape : </h3>
                <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
                    <?php include('Composant/SelectEtapes.php') ?>
                    <div class="listeInfo" data-template="templateFormSupprimerEtapes"></div>
                </div>
            </section>
        </article>
        <article>
            <h2 class="h4 mb-3  text-danger"> Modification : </h2>
            <section class="mb-5">
                <h3 class="h4 mb-3"> Modifier un invité : </h3>
                <div data-api="API/recupListeInvites.php" class="formListeFiltreOrdre">
                    <?php include('Composant/SelectInvites.php') ?>
                    <div class="listeInfo" data-template="templateFormModifInvites"></div>
                </div>

            </section>
            <section class="mb-5">
                <h3 class="h4 mb-3"> Modifier une Etape : </h3>
                <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
                    <?php include('Composant/SelectEtapes.php') ?>
                    <div class="listeInfo" data-template="templateFormModifEtapes"></div>
                </div>
            </section>
        </article>
        <article>
            <h2 class="h4 mb-3">Ajout :</h2>
            <section class="mb-5">
                <h3 class="h4 mb-3">Ajouter un invité :</h3>
                <form action="adminAjouterTraiter.php" method="POST" enctype="multipart/form-data">
                    <?= creerChamp('type', '', 'invites', 'hidden') ?>
                    <?= creerChamp('nom_invite', 'Nom', '', 'text') ?>
                    <?= creerChamp('prenom_invite', 'Prénom', '', 'text') ?>
                    <?= creerChamp('description_invite', 'Description', '', 'textarea') ?>
                    <?= creerChamp('contact_invite', 'Contact', '', 'text') ?>
                    <?= creerChamp('image_invite', 'Image', '', 'file', true) ?>
                    <input type="submit" value="Ajouter">
                </form>
            </section>
            <section class="mb-5">
                <h3 class="h4 mb-3">Ajouter une Étape :</h3>
                <form action="adminAjouterTraiter.php" method="POST" enctype="multipart/form-data">
                    <?= creerChamp('type', '', 'etapes', 'hidden') ?>
                    <?= creerChamp('nom_etape', 'Nom', '', 'text') ?>
                    <?= creerChamp('description_etape', 'Description', '', 'textarea') ?>
                    <?= creerChamp('date_etape', 'Date', '', 'date') ?>
                    <?= creerChamp('heure_etape', 'Heure', '', 'text') ?>
                    <?= creerChamp('lieu_etape', 'Lieu', '', 'text') ?>
                    <?= creerChamp('ville_etape', 'Ville', '', 'text') ?>
                    <?= creerChamp('image_etape', 'Image', '', 'file', true) ?>
                    <?= creerChamp('illustration_etape', 'Illustration', '', 'file', true) ?>
                    <input type="submit" value="Ajouter">
                </form>
            </section>
        </article>

    </main>
    <?php include 'Composant/Footer.php' ?>
</body>

</html>