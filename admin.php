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
                    <label for="ordre">Ordre : </label>
                    <select class="ordre">
                        <option value="nom_invite ASC">Nom (A → Z)</option>
                        <option value="nom_invite DESC">Nom (Z → A)</option>
                        <option value="prenom_invite ASC">Prénom (A → Z)</option>
                        <option value="prenom_invite DESC">Prénom (Z → A)</option>
                    </select>

                    <label for="filtre">Filtre : </label>
                    <select class="filtre">
                        <option value="nom_invite" data-type="text">Nom</option>
                        <option value="prenom_invite" data-type="text">Prénom</option>
                    </select>

                    <label for="filtreValeur">Valeur : </label>
                    <input type="text" class="filtreValeur" placeholder="Entrez une valeur">
                    <div class="listeInfo" data-template="templateFormSupprimerInvites"></div>
                </div>

            </section>
            <section>
                <h3> Supprimer une Etape : </h3>
                <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
                    <label for="ordre">Ordre : </label>
                    <select class="ordre">
                        <option value="date_etape ASC, heure_etape ASC">Date (ascendant)</option>
                        <option value="date_etape DESC, heure_etape DESC">Date (descendant)</option>
                        <option value="nom_etape ASC">Nom (A -> Z)</option>
                        <option value="nom_etape DESC">Nom (Z -> A)</option>
                        <option value="ville_etape ASC">Ville (A -> Z)</option>
                        <option value="ville_etape DESC">Ville (Z -> A)</option>
                    </select>

                    <label for="filtre">Filtre : </label>
                    <select class="filtre">
                        <option value="nom_etape" data-type="text">Nom</option>
                        <option value="ville_etape" data-type="text">Ville</option>
                        <option value="nom_etape" data-type="text">Nom</option>
                        <option value="date_etape" data-type="date">Date</option>
                    </select>

                    <label for="filtreValeur">Valeur : </label>
                    <input type="text" class="filtreValeur" placeholder="Entrez une valeur">
                    <div class="listeInfo" data-template="templateFormSupprimerEtapes"></div>
                </div>
            </section>
        </article>
        <article>
            <h2> Modification : </h2>
            <section>
                <h3> Modifier un invité : </h3>
                <div data-api="API/recupListeInvites.php" class="formListeFiltreOrdre">
                    <label for="ordre">Ordre : </label>
                    <select class="ordre">
                        <option value="nom_invite ASC">Nom (A → Z)</option>
                        <option value="nom_invite DESC">Nom (Z → A)</option>
                        <option value="prenom_invite ASC">Prénom (A → Z)</option>
                        <option value="prenom_invite DESC">Prénom (Z → A)</option>
                    </select>

                    <label for="filtre">Filtre : </label>
                    <select class="filtre">
                        <option value="nom_invite" data-type="text">Nom</option>
                        <option value="prenom_invite" data-type="text">Prénom</option>
                    </select>

                    <label for="filtreValeur">Valeur : </label>
                    <input type="text" class="filtreValeur" placeholder="Entrez une valeur">
                    <div class="listeInfo" data-template="templateFormModifInvites"></div>
                </div>

            </section>
            <section>
                <h3> Modifier une Etape : </h3>
                <div data-api="API/recupListeEtapes.php" class="formListeFiltreOrdre">
                    <label for="ordre">Ordre : </label>
                    <select class="ordre">
                        <option value="date_etape ASC, heure_etape ASC">Date (ascendant)</option>
                        <option value="date_etape DESC, heure_etape DESC">Date (descendant)</option>
                        <option value="nom_etape ASC">Nom (A -> Z)</option>
                        <option value="nom_etape DESC">Nom (Z -> A)</option>
                        <option value="ville_etape ASC">Ville (A -> Z)</option>
                        <option value="ville_etape DESC">Ville (Z -> A)</option>
                    </select>

                    <label for="filtre">Filtre : </label>
                    <select class="filtre">
                        <option value="nom_etape" data-type="text">Nom</option>
                        <option value="ville_etape" data-type="text">Ville</option>
                        <option value="nom_etape" data-type="text">Nom</option>
                        <option value="date_etape" data-type="date">Date</option>
                    </select>

                    <label for="filtreValeur">Valeur : </label>
                    <input type="text" class="filtreValeur" placeholder="Entrez une valeur">
                    <div class="listeInfo" data-template="templateFormModifEtapes"></div>
                </div>
            </section>
        </article>
    </main>
    <?php include 'Composant/Footer.php' ?>
</body>

</html>