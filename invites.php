<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Invites.php');

// Récupération des invités depuis la base de données
$tab = Invites::getListeInvites(); // Méthode qui retourne un tableau d'invités
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Invités</title>
</head>

<body>
    <?php include('Composant/Header.php'); ?>
    <main>
        <div class="container">
            <?php foreach ($tab as $invite): ?>
                <a href="invite.php?id_invite=<?php echo $invite['id_invite']; ?>"></a>
                    <div class="row mb-4 align-items-center text-center">
                        <!-- Colonne pour l'image -->
                        <div class="col-md-6 d-flex justify-content-center">
                            <img src="<?php echo $invite['image_invite']; ?>" class="img-fluid" alt="Image invité">
                        </div>
                        <!-- Colonne pour les informations -->
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h5 class="text-danger fw-bold"><?php echo $invite['nom_invite'] . " " . $invite['prenom_invite']; ?></h5>
                            <p>
                                <?php echo $invite['description_invite']; ?><br>
                                <div class="fst-italic"><?php echo $invite['contact_invite']; ?></div>
                            </p>
                        </div>
                    </div>
                
            <?php endforeach; ?>
        </div>
    </main>
    <?php
    include 'Composant/scrollTopBtn.php';
    include 'Composant/Footer.php';
    ?>
</body>

</html>