<?php
    include_once('config/config.php');
    include_once('fonction/fonction.php');
    include_once('class/Users.php');
    include_once('class/Invites.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php echo metadata();?>
    <meta charset="UTF-8">
    <meta name="keywords" content="Liste des invités">
    <meta name="description" content="Liste des invités présents lors du Kids Tour AS Monacoeur">
    <title>Etapes</title>
</head>
<body>
    <?php include('Composant/Header.php'); ?>

    <?php
    // Récupération des invités depuis la base de données
    $tab = Invites::getListeInvites(); // Méthode qui retourne un tableau d'invités
    ?>

    <div class="container">
        <?php foreach ($tab as $invite): ?>
            <a href="Invites.php?id_invite=<?php echo $invite['id_invite']; ?>">
                <div class="row mb-4 align-items-center text-center">
                    <!-- Colonne pour l'image -->
                    <div class="col-md-6 d-flex justify-content-center">
                        <img src="<?php echo $invite['image_invite']; ?>" class="img-fluid" alt="Image invité">
                    </div>
                    <!-- Colonne pour les informations -->
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold"><?php echo $invite['nom_invite'] . " " . $invite['prenom_invite']; ?></h5>
                        <p>
                            <?php echo $invite['description_invite']; ?><br>
                            <?php echo $invite['contact_invite']; ?>
                        </p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
