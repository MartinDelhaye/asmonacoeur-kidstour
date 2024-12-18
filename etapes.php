<?php
    include_once('config/config.php');
    include_once('fonction/fonction.php');
    include_once('class/Users.php');
    include_once('class/Etapes.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php echo metadata();?>
    <meta charset="UTF-8">
    <meta name="keywords" content="Liste des étapes">
    <meta name="description" content="Liste des étapes du parcours du Kids Tour AS Monacoeur">
    <title>Etapes</title>
</head>
<body>
    <?php include('Composant/Header.php'); ?>

    <?php

    //echo 
    // Récupération des invités depuis la base de données
    $tab = Etapes::getListeEtapes(); // Méthode qui retourne un tableau d'étapes
    ?>

    <div class="container">
        <?php foreach ($tab as $etape): ?>
            <a href="Etapes.php?id_etape=<?php echo $etape['id_etape']; ?>">
                <div class="row mb-4 align-items-center text-center">
                    <!-- Colonne pour l'image -->
                    <div class="col-md-6 d-flex justify-content-center">
                        <img src="<?php echo $etape['image_etape']; ?>" class="img-fluid" alt="Image étape">
                    </div>
                    <!-- Colonne pour les informations -->
                    <div class="col-md-6 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold"><?php echo $etape['nom_etape']?></h5>
                        <p>
                            <?php echo $etape['date_etape']; ?><br>
                            <?php echo $etape['lieu_etape']; ?><br>
                            <?php echo $etape['description_etape']; ?><br>
                        </p>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>
