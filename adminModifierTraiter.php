<?php
// Inclusion des fichiers nécessaires
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');

// Debugging: Affichage des données POST et FILES
print_r($_POST);
echo "<br>";
print_r($_FILES);

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

if (isset($_POST['type']) && isset($_POST['id'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
    unset($_POST['type'], $_POST['id']);

    // Appel de la méthode de modification
    $message = $user->modifierElement($type, $id, $_POST, $_FILES);

    // Gestion des messages success/error dans la session
    if ($message === "Données modifiées") {
        $_SESSION['message_success'] = $message;
    } else {
        $_SESSION['message_error'] = $message;
    }
} else {
    $_SESSION['message_error'] = "Paramètres manquants ou invalides";
}

print_r($_SESSION);

// Redirection vers la page d'administration après l'affichage du message
header('Location: admin.php');
exit();
?>
