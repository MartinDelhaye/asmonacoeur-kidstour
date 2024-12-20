<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Etapes.php');
include_once('class/Invites.php');

// Vérification utilisateur
if (!isUserLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user = $_SESSION['compte'];

if (!($user instanceof MembreAssociation)) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le type de formulaire (invites ou etapes)
    $type = $_POST['type'];

    // Variables communes aux deux types
    $nom = $_POST['nom_invite'] ?? $_POST['nom_etape'];
    $prenom = $_POST['prenom_invite'] ?? null;
    $description = $_POST['description_invite'] ?? $_POST['description_etape'];
    $contact = $_POST['contact_invite'] ?? null;
    $date = $_POST['date_etape'] ?? null;
    $heure = $_POST['heure_etape'] ?? null;
    $lieu = $_POST['lieu_etape'] ?? null;
    $ville = $_POST['ville_etape'] ?? null;

    // Gérer les fichiers téléchargés
    $image = $imagePath = '';
    if (!empty($_FILES['image_invite']['name']) || !empty($_FILES['image_etape']['name'])) {
        $image = ($_FILES['image_invite']['name'] != '') ? $_FILES['image_invite'] : $_FILES['image_etape'];
        $imagePath = 'images/' . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    $illustration = $illustrationPath = '';
    if (!empty($_FILES['illustration_etape']['name'])) {
        $illustration = $_FILES['illustration_etape'];
        $illustrationPath = 'images/' . basename($illustration['name']);
        move_uploaded_file($illustration['tmp_name'], $illustrationPath);
    }

    // Ajout dans la base de données
    if ($type === 'invites') {
        // Ajouter un invité
        $ajoutInvite = $user->ajouterInvite($nom, $prenom, $description, $contact, $imagePath);
        if ($ajoutInvite) {
            $_SESSION['message_success'] = 'Invité ajouté avec succès!';
        } else {
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'invité.';
        }
    } elseif ($type === 'etapes') {
        // Ajouter une étape
        $ajoutEtape = $user->ajouterEtape($nom, $description, $date, $heure, $lieu, $ville, $imagePath, $illustrationPath);
        if ($ajoutEtape) {
            $_SESSION['message_success'] = 'Étape ajoutée avec succès!';
        } else {
            $_SESSION['message_error'] = 'Erreur lors de l\'ajout de l\'étape.';
        }
    }

    // Redirection après ajout
    header('Location: admin.php');
    exit();
}
?>
