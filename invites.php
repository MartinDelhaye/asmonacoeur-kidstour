<?php
    include_once('config/config.php');
    include_once('fonction/fonction.php');
    include_once('class/Users.php');
    include_once('class/Invites.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invités</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('Composant/Header.php'); ?>

    <?php
    // Récupération des invités depuis la base de données
    $tab = Invite::getListeInvite(); // Méthode qui retourne un tableau d'invités
    print_r($tab);
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
