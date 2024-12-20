<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

// Redirection si l'utilisateur n'est pas connecté
if (!isUserLoggedIn()) {
    header('Location: connexion.php');
    exit();
}

$user = $_SESSION['compte'];

if($user instanceof MembreAssociation){
    include_once('Composant/templateListeEtapesMembreAssociation.php');
}
elseif($user instanceof Participant){
    include_once('Composant/templateListeEtapesParticipant.php');
}

// Gestion des actions Déconnexion et Suppression de compte
if (isset($_GET['logout'])) {
    session_destroy(); // Déconnexion de l'utilisateur
    header('Location: connexion.php');
    exit();
}

if (isset($_POST['delete_account'])) {
    if ($user instanceof Users) {
        $user->supprimerCompte(); // Méthode pour supprimer le compte
    }
    session_destroy(); // On détruit la session après suppression
    header('Location: connexion.php');
    exit();
}

// Gestion de la modification des informations
$userNom = $user->getNomUser();
$userPrenom = $user->getPrenomUser();
$userLogin = $user->getLoginUser();

if (isset($_POST['nom'], $_POST['prenom'], $_POST['login'])) {
    $nomModif = $userNom != $_POST["nom"] ? $_POST['nom'] : null;
    $prenomModif = $userPrenom != $_POST["prenom"] ? $_POST['prenom'] : null;
    $loginModif = $userLogin != $_POST["login"] ? $_POST['login'] : null;

    $user->modifInfos($nomModif, $prenomModif, $loginModif);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="AS MONACOEUR, compte AS MONACOEUR, calendrier AS MONACOEUR, étapes AS MONACOEUR, événements AS MONACOOEUR">
    <meta name="description" content="Gérez votre compte et les étapes AS MONACOEUR facilement.">
    <title>Compte</title>
</head>

<body>
    <?php include 'Composant/Header.php'; ?>

    <main class="container my-5">
        <!-- Titre principal -->
        <div class="text-center mb-4">
            <h1 class="display-5 text-danger p-5">Mon Compte</h1>
            <p class="lead">Bonjour <strong><?php echo htmlspecialchars($userPrenom . ' ' . $userNom); ?></strong> !</p>
        </div>

        <!-- Boutons Déconnexion et Suppression -->
        <section class="text-center mb-4">
            <form action="compte.php" method="GET" class="d-inline">
                <button type="submit" name="logout" class="btn btn-outline-danger shadow-sm me-2">
                    Déconnexion
                </button>
            </form>
            <form action="compte.php" method="POST" class="d-inline">
                <button type="submit" name="delete_account" class="btn btn-danger shadow-sm" 
                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                    Supprimer le compte
                </button>
            </form>
        </section>

        <!-- Formulaire Modifier Informations -->
        <section class="mb-5">
            <h2 class="h4 mb-3">Modifier vos informations</h2>
            <form action="compte.php" method="post" class="bg-light p-4 rounded shadow-sm">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" value="<?php echo htmlspecialchars($userNom); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="<?php echo htmlspecialchars($userPrenom); ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="login" class="form-label">Email</label>
                        <input type="email" name="login" class="form-control" value="<?php echo htmlspecialchars($userLogin); ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger w-100">Mettre à jour</button>
            </form>
        </section>

        <!-- Section Modifier Mot de Passe -->
        <section class="mb-5">
            <h2 class="h4 mb-3">Modifier votre mot de passe</h2>
            <form action="compte.php" method="post" class="bg-light p-4 rounded shadow-sm">
                <div class="mb-3">
                    <label for="mdp_anc" class="form-label">Mot de passe actuel</label>
                    <input type="password" name="mdp_anc" class="form-control" placeholder="Mot de passe actuel" required>
                </div>
                <div class="mb-3">
                    <label for="mdp" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="mdp" class="form-control" placeholder="Nouveau mot de passe" required>
                </div>
                <div class="mb-3">
                    <label for="mdp_verif" class="form-label">Confirmation du mot de passe</label>
                    <input type="password" name="mdp_verif" class="form-control" placeholder="Confirmez le mot de passe" required>
                </div>
                <button type="submit" class="btn btn-danger w-100">Modifier</button>
            </form>
        </section>

        <!-- Section Liste des Étapes -->
        <section>
            <h2 class="h4 mb-3">Liste de vos étapes</h2>
            <div class="bg-light p-4 rounded shadow-sm">
            <div data-api="API/recupListeEtapesUser.php"  id="formListeFiltreOrdre">
                    <div class="col-md-4">
                        <label for="ordre" class="form-label">Ordre</label>
                        <select id="ordre" class="form-select">
                            <option value="date_etape ASC, heure_etape ASC">Date (ascendant)</option>
                            <option value="date_etape DESC, heure_etape DESC">Date (descendant)</option>
                            <option value="nom_etape ASC">Nom (A → Z)</option>
                            <option value="nom_etape DESC">Nom (Z → A)</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filtre" class="form-label">Filtre</label>
                        <select id="filtre" class="form-select">
                            <option value="nom_etape">Nom</option>
                            <option value="date_etape">Date</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filtreValeur" class="form-label">Valeur</label>
                        <input type="text" id="filtreValeur" class="form-control" placeholder="Entrez une valeur">
                    </div>
                </div>
                <div id="listeInfo" data-template="templateListeEtapes">
                    <p class="text-muted">Les données seront affichées ici.</p>
                </div>
            </div>
        </section>
    </main>

    <?php include 'Composant/Footer.php'; ?>
</body>

</html>
