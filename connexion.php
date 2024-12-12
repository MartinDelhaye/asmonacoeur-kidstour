<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $user = Users::connexion($login, $mdp);

    if ($user instanceof Users) {
        $_SESSION['compte'] = $user;
        print_r($_SESSION['compte']);
    } else {
        echo $user;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<?php echo metadata(); ?>
<meta name="keywords" content="">
<meta name="description" content="" />
<title>Connexion</title>
</head>

<body>
    <form action="" method="POST">
        <input type="text" name="login" placeholder="Nom d'utilisateur">
        <input type="password" name="mdp" placeholder="Mot de passe">
        <input type="submit" value="Connexion">
    </form>
</body>

</html>