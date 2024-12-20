<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Etapes.php');
include_once('class/Invites.php');

// Vérification utilisateur
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

// Récupération des données
$id_invite = isset($_POST['id_invite']) ? $_POST['id_invite'] : null;
$id_etape = isset($_POST['id_etape']) ? $_POST['id_etape'] : null;

$data = [];
if ($id_invite) {
    $invite = new Invites($id_invite);
    $data['type'] = 'invites';
    $data['id'] = $id_invite;
    $data['nom_invite'] = $invite->getNomInvite();
    $data['prenom_invite'] = $invite->getPrenomInvite();
    $data['description_invite'] = $invite->getDescInvite();
    $data['contact_invite'] = $invite->getContactInvite();
    $data['image_invite'] = $invite->getImageInvite();
} elseif ($id_etape) {
    $etape = new Etapes($id_etape);
    $data['type'] = 'etapes';
    $data['id'] = $id_etape;
    $data['nom_etape'] = $etape->getNomEtape();
    $data['description_etape'] = $etape->getDescEtape();
    $data['date_etape'] = $etape->getDateEtape();
    $data['heure_etape'] = $etape->getHeureEtape();
    $data['lieu_etape'] = $etape->getLieuEtape();
    $data['ville_etape'] = $etape->getVilleEtape();
    $data['image_etape'] = $etape->getImageEtape();
    $data['illustration_etape'] = $etape->getIlluEtape();
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php echo metadata(); ?>
    <title>Modification</title>
</head>

<body>
    <h1>Modifier</h1>
    <form action="adminModifierTraiter.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="<?= $data['type'] ?>">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="reset" value="Reset vos modifications"><br>

        <?php
        if ($data['type'] === 'invites') {
            echo creerChamp('nom_invite', 'Nom', $data['nom_invite']);
            echo creerChamp('prenom_invite', 'Prénom', $data['prenom_invite']);
            echo creerChamp('description_invite', 'Description', $data['description_invite'], 'textarea');
            echo creerChamp('contact_invite', 'Contact', $data['contact_invite']);
            echo creerChamp('image_invite', 'Image', $data['image_invite'], 'file', true);
        } elseif ($data['type'] === 'etapes') {
            echo creerChamp('nom_etape', 'Nom', $data['nom_etape']);
            echo creerChamp('description_etape', 'Description', $data['description_etape'], 'textarea');
            echo creerChamp('date_etape', 'Date', $data['date_etape'], 'date');
            echo creerChamp('heure_etape', 'Heure', $data['heure_etape']);
            echo creerChamp('lieu_etape', 'Lieu', $data['lieu_etape']);
            echo creerChamp('ville_etape', 'Ville', $data['ville_etape']);
            echo creerChamp('image_etape', 'Image', $data['image_etape'], 'file', true);
            echo creerChamp('illustration_etape', 'Illustration', $data['illustration_etape'], 'file', true);
        }
        ?>

        <br>
        <input type="submit" value="Modifier">
    </form>
    <a href="admin.php" title="retour page administration"><button>Annuler</button></a>

</body>

</html>
