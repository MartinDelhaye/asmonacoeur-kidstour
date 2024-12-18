<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');


if (!isUserLoggedIn())
    header('Location: connexion.php');
else
    $user = $_SESSION['compte'];

if (!($user instanceof MembreAssociation)) {
    header('Location: index.php');
}

include_once('Composant/templateFormSupprimerInvites.php');

// print_r($_SESSION['compte']);

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
    <?php include 'Composant/header.php' ?>
    <main>
        <h1>Page d'administration</h1>

        <article>
            <h2> Les invités : </h2>
            <section>
                <h3> Supprimer un invité : </h3>
                <div data-api="API/recupListeInvites.php" id="formListeFiltreOrdre">
                    <label for="ordre">Ordre : </label>
                    <select id="ordre">
                        <option value="nom_invite ASC">Nom (A → Z)</option>
                        <option value="nom_invite DESC">Nom (Z → A)</option>
                        <option value="prenom_invite ASC">Prénom (A → Z)</option>
                        <option value="prenom_invite DESC">Prénom (Z → A)</option>
                    </select>

                    <label for="filtre">Filtre : </label>
                    <select id="filtre">
                        <option value="nom_invite" data-type="text">Nom</option>
                        <option value="prenom_invite" data-type="text">Prénom</option>
                    </select>

                    <label for="filtreValeur">Valeur : </label>
                    <input type="text" id="filtreValeur" placeholder="Entrez une valeur">
                </div>
                <!-- <div ></div> -->
                <form class="formAdmin">
                    <select name="id_invite" id="listeInfo" data-template="templateFormSupprimerInvites">
                    </select>
                </form>
            </section>
        </article>
    </main>
    <?php include 'Composant/footer.php' ?>
</body>

</html>