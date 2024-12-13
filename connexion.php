<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

isUserLoggedIn();
if(isset($_SESSION['compte'])) header('Location: compte.php');

if (isset($_POST['login']) && !isset($_POST['nom'])) {
    // print_r($_POST);
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $user = Users::connexion($login, $mdp);

    if ($user instanceof Users) {
        $_SESSION['compte'] = $user;
        print_r($_SESSION['compte']);
    } else
        $message_erreur = $user;
}
if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['nom'])) {
    // print_r($_POST);
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $mdp_verif = $_POST['mdp_verif'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    if ($mdp != $mdp_verif) $message_erreur = "Les mots de passe ne correspondent pas";
    if (Users::loginExist($login)) $message_erreur = "Le login est deja pris";

    if (!isset($message_erreur)) {
        $user = Users::createUser($login, $mdp, $nom, $prenom);
        if ($user instanceof Users) {
            $_SESSION['compte'] = $user;
            header('Location: compte.php');
            exit();
        } else {
            $message_erreur = $user;
        }        
    }
}

// Temporaire (pour faire des tests)
if (isset($message_erreur))
    echo $message_erreur;
else
    echo "Vous devez vous connecter";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <title>Connexion</title>
</head>

<body>
    <!-- Connexion -->
    <form action="" method="POST">
        <label>Login : <input type="text" name="login" placeholder="Nom d'utilisateur" required></label>
        <input type="password" name="mdp" placeholder="Mot de passe" required>
        <input type="submit" value="Connexion">
    </form>

    <!-- Inscription -->
    <form action="" method="POST">
        <input type="text" name="login" placeholder="Nom d'utilisateur" required>
        <input type="password" name="mdp" placeholder="Mot de passe" required>
        <input type="password" name="mdp_verif" placeholder="Mot de passe" required>
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prenom" required>

        <input type="submit" value="Connexion">
    </form>
</body>

</html>