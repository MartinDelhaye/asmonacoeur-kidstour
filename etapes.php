<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Etapes.php');

// Récupération des invités depuis la base de données
$tab = Etapes::getListeEtapes(); // Méthode qui retourne un tableau d'étapes
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Etapes</title>
</head>

<body>
    <?php include('Composant/Header.php'); ?>
    <main>
    <h1 class="text-danger fw-bold d-flex justify-content-center align-items-center text-center">Les étapes</h1>
        <div class="container">
            <?php foreach ($tab as $etape): ?>
                <a href="etape.php?id_etape=<?php echo $etape['id_etape']; ?>"> </a>
                    <div class="row mb-4 align-items-center text-center">
                        <!-- Colonne pour l'image -->
                        <div class="col-md-6 d-flex justify-content-center">
                            <img src="<?php echo $etape['image_etape']; ?>" class="img-fluid" alt="Image étape">
                        </div>
                        <!-- Colonne pour les informations -->
                        <div class="col-md-6 d-flex flex-column justify-content-center">
                            <h5 class="text-danger fw-bold"><?php echo $etape['nom_etape'] ?></h5>
                            <p>
                               <div class="fst-italic"> <?php echo $etape['date_etape']; ?><br>
                                <?php echo $etape['lieu_etape']; ?><br> </div>
                                <?php echo $etape['description_etape']; ?><br>
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