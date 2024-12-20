<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

isUserLoggedIn();
if (isset($_SESSION['compte']))
    header('Location: compte.php');
// print_r($_POST);
if (isset($_POST['login']) && !isset($_POST['nom'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];

    $user = Users::connexion($login, $mdp);

    if ($user instanceof Users) {
        $_SESSION['compte'] = $user;
        header('Location: compte.php');
    } else
        $message_erreur = $user;
}

if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['nom'])) {
    $login = $_POST['login'];
    $mdp = $_POST['mdp'];
    $mdp_verif = $_POST['mdp_verif'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    if ($mdp != $mdp_verif)
        $message_erreur = "Les mots de passe ne correspondent pas";
    if (Users::loginExist($login))
        $message_erreur = "Le login est deja pris";

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

//if (isset($message_erreur))
//echo $message_erreur;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="AS MONACOEUR, connexion AS MONACOEUR, inscription AS MONACOEUR, utilisateur AS MONACOEUR, mot de passe AS MONACOEUR">
    <meta name="description" content="Connectez-vous ou inscrivez-vous sur la plateforme AS MONACOEUR." />
    <title>Connexion</title>
</head>

<body>
    <?php include('Composant/Header.php'); ?>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Connexion -->
                    <div class="card shadow">
                        <div class="card-header bg-danger text-white text-center">
                            Connexion
                        </div>
                        <div class="card-body">
                            <?php if (!empty($message_erreur)): ?>
                                <div class="alert alert-danger"><?php echo $message_erreur; ?></div>
                            <?php endif; ?>
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Email
                                        <input type="text" name="login" class="form-control" placeholder="Email"
                                            required>
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mot de passe
                                        <input type="password" name="mdp" class="form-control"
                                            placeholder="Mot de passe" required>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-danger w-100">Se connecter</button>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <small>Vous n'avez pas de compte ? <a href="#inscription" class="text-danger"
                                    onclick="toggleForm()">Inscrivez-vous</a></small>
                        </div>
                    </div>
                </div>


                <div class="col-md-6" id="inscription-form" style="display: none;">
                    <div class="card shadow">
                        <div class="card-header bg-danger text-white text-center">
                            Inscription
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="login" class="form-label">Email</label>
                                    <input type="text" name="login" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="mdp" class="form-label">Mot de passe</label>
                                    <input type="motdepasse" name="mdp" class="form-control" placeholder="Mot de passe"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="mdp_verif" class="form-label">Confirmez le mot de passe</label>
                                    <input type="password" name="mdp_verif" class="form-control"
                                        placeholder="Confirmez le mot de passe" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                                </div>
                                <button type="submit" class="btn btn-danger w-100">Créer un compte</button>
                            </form>
                        </div>
                        <div class="connexion">
                            <small>Déjà inscrit ? <a href="#connexion" class="text-danger"
                                    onclick="toggleForm()">Connectez-vous</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        function toggleForm() {
            const loginForm = document.querySelector('.col-md-6:first-of-type');
            const inscriptionForm = document.getElementById('inscription-form');
            loginForm.style.display = (loginForm.style.display === "none") ? "block" : "none";
            inscriptionForm.style.display = (inscriptionForm.style.display === "none") ? "block" : "none";
        }
    </script>
    <?php
    include 'Composant/scrollTopBtn.php';
    include 'Composant/Footer.php';
    ?>
</body>

</html>