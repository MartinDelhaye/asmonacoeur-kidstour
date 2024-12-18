<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');


if (!isUserLoggedIn())
    header('Location: connexion.php');
else $user = $_SESSION['compte'];

if($user instanceof MembreAssociation){
    include_once('Composant/templateListeEtapesMembreAssociation.php');
}
elseif($user instanceof Participant){
    include_once('Composant/templateListeEtapesParticipant.php');
}

// print_r($_SESSION['compte']);

$userNom = $user->getNomUser();
$userPrenom = $user->getPrenomUser();
$userLogin = $user->getLoginUser();


if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['login'])) {

    if ($userNom != $_POST["nom"])
        $nomModif = $_POST['nom'];
    else
        $nomModif = null;

    if ($userPrenom != $_POST["prenom"])
        $prenomModif = $_POST['prenom'];
    else
        $prenomModif = null;

    if ($userLogin != $_POST["login"])
        $loginModif = $_POST['login'];
    else
        $loginModif = null;

    $user->modifInfos($nomModif, $prenomModif, $loginModif);
}


// Deconnexion (temporaire)
// $_SESSION['compte']->deconnexion();
// header('Location: connexion.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <title>Compte</title>
</head>

<body>
    <?php include 'Composant/header.php'  ?>
    <main>
        <h1>Compte</h1>
        <p>Vous etes connecter en tant que : <?php echo $userPrenom . ' ' . $userNom ?></p>

        <h2>Modifier vos informations</h2>
        <form action="compte.php" method="post">
            <input type="text" name="nom" placeholder="Nom" value="<?php echo $userNom; ?>"> <br>
            <input type="text" name="prenom" placeholder="Prenom" value="<?php echo $userPrenom; ?>"><br>
            <input type="email" name="login" placeholder="Email" value="<?php echo $userLogin; ?>"> <br>
            <input type="submit" value="Mettre à jour"> <br>
        </form>
        <h2>Modifier votre mot de passe</h2>
        <form action="compte.php" method="post">
            <input type="password" name="mdp_anc" placeholder="Mot de passe Actuel"> <br>
            <input type="password" name="mdp" placeholder="Nouveau Mot de passe"> <br>
            <input type="password" name="mdp_verif" placeholder="Confirmation du mot de passe"> <br>
            <input type="submit" value="Modifier"> <br>
        </form>

        <article>
            <h2> Liste de vos étapes : </h2>
            <div data-api="API/recupListeEtapesUser.php"  id="formListeFiltreOrdre">
                <label for="ordre">Ordre : </label>
                <select id="ordre">
                    <option value="date_etape ASC, heure_etape ASC">Date (ascendant)</option>
                    <option value="date_etape DESC, heure_etape DESC">Date (descendant)</option>
                    <option value="nom_etape ASC">Nom (A → Z)</option>
                    <option value="nom_etape DESC">Nom (Z → A)</option>
                </select>

                <label for="filtre">Filtre : </label>
                <select id="filtre">
                    <option value="nom_etape" data-type="text">Nom</option>
                    <option value="date_etape" data-type="date" >Date</option>
                </select>

                <label for="filtreValeur">Valeur : </label>
                <input type="text" id="filtreValeur" placeholder="Entrez une valeur">
            </div>
            <div id="listeInfo" data-template="templateListeEtapes"></div>
        </article>
    </main>
    <?php include 'Composant/footer.php'  ?>
</body>
</html>