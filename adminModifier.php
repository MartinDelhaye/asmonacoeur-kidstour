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
        <input type="reset" value="Reset vos modifiaction"><br>

        <?php if ($data['type'] === 'invites'): ?>
            <label>
                Nom : <input type="text" name="nom_invite" value="<?= $data['nom_invite'] ?>">
            </label>
            <br>
            <label>
                Prénom : <input type="text" name="prenom_invite" value="<?= $data['prenom_invite'] ?>">
            </label>
            <br>
            <label>
                Description : <textarea name="description_invite"><?= $data['description_invite'] ?></textarea>
            </label>
            <br>
            <label>
                Contact : <input type="text" name="contact_invite" value="<?= $data['contact_invite'] ?>">
            </label>
            <br>
            <label>
                Image : <input type="file" name="image_invite">
                <p>Image actuelle :</p>
                <img src="<?= $data['image_invite'] ?>" alt="Image actuelle" style="max-width: 200px; max-height: 200px;">
            </label>
        <?php elseif ($data['type'] === 'etapes'): ?>
            <label>
                Nom : <input type="text" name="nom_etape" value="<?= $data['nom_etape'] ?>">
            </label>
            <br>
            <label>
                Description : <textarea name="description_etape"><?= $data['description_etape'] ?></textarea>
            </label>
            <br>
            <label>
                Date : <input type="date" name="date_etape" value="<?= $data['date_etape'] ?>">
            </label>
            <br>
            <label>
                Heure : <input type="text" name="heure_etape" value="<?= $data['heure_etape'] ?>">
            </label>
            <br>
            <label>
                Lieu : <input type="text" name="lieu_etape" value="<?= $data['lieu_etape'] ?>">
            </label>
            <br>
            <label>
                Ville : <input type="text" name="ville_etape" value="<?= $data['ville_etape'] ?>">
            </label>
            <br>
            <label>
                Image : <input type="file" name="image_etape">
                <p>Image actuelle :</p>
                <img src="<?= $data['image_etape'] ?>" alt="Image actuelle" style="max-width: 200px; max-height: 200px;">
            </label>
            <br>
            <label>
                Illustration : <input type="file" name="illustration_etape">
                <p>Illustration actuelle :</p>
                <img src="<?= $data['illustration_etape'] ?>" alt="Illustration actuelle"
                    style="max-width: 200px; max-height: 200px;">
            </label>
        <?php endif; ?>
        <br>
        <input type="submit" value="Modifier">
    </form>
    <a href="admin.php" title="retour page administration"><button>Annuler</button></a>

</body>

</html>
