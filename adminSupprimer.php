<?php
// Inclusion des fichiers nécessaires
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

// Vérifier si l'utilisateur est connecté et est un membre de l'association
if (isUserLoggedIn()) {
    $user = $_SESSION['compte'];
    if (!($user instanceof MembreAssociation)) {
        header('Location: index.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}

// Initialisation des paramètres
$id = null;
$key_id = null;
$table = null;

if (isset($_POST['id_invite'])) {
    $id = (int)$_POST['id_invite'];
    $key_id = 'id_invite';
    $table = 'invites';
} elseif (isset($_POST['id_etape'])) {
    $id = (int)$_POST['id_etape'];
    $key_id = 'id_etape';
    $table = 'etapes';
}


// Vérification des paramètres requis
if ($id !== null && $key_id !== null && $table !== null) {
    // Appel à la méthode de suppression
    $message = $user->supprimerDonnees($table, $key_id, $id);

    if ($message === "Données supprimées") {
        $_SESSION['message_success'] = $message;
    } else {
        $_SESSION['message_error'] = "La suppression a échoué";
    }
} else {
    $_SESSION['message_error'] = "Paramètres manquants ou invalides";
}


// Encodage de la réponse en JSON et affichage
header('Location: admin.php');
exit();

