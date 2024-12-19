<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Invites.php');

$invite = new Invites($_GET["id_invite"]);

//$tabAnime = $invite->getListeOrganisateur();

$tabInvites = $invite->getListeInvites();

// récupération des données //
$id_invite = $invite->getIdInvite();
$nom_invite = $invite->getNomInvite();
$prenom_invite = $invite->getPrenomInvite();
$description_invite = $invite->getDescInvite();
$image_invite = $invite->getImageInvite();
$contact_invite = $invite->getContactInvite();
$liste_etapes = $invite->getListeEtapes();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Invite</title>
</head>

<body>
    <?php include 'Composant/Header.php'; ?>
    <main>
        <div class="container">
            <div class="text-center">
                <h1 class="fw-bold titre1 invite1"><?php echo $prenom_invite.' '. $nom_invite;?></h1>
                <img src="<?php echo $image_invite; ?>" alt="Joueur de foot">
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center my-4">
                <div class="col-12 section-description">
                    <p><?php echo $description_invite; ?></p>
                </div>
            </div>
        </div>


        <!-- Carousel Images à changer--> 
        <div class="container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Images/Temp_kidstour_Complet.jpg" class="d-block w-100" alt="Etape 1">
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Temp_kidstour_Cap_dAil.jpg" class="d-block w-100" alt="Etape 2">
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Temp_kidstour_LaTurbine.jpg" class="d-block w-100" alt="Etape 3">
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Temp_kidstour_Fayences_Levens.jpg" class="d-block w-100" alt="Etape 4">
                    </div>
                    <div class="carousel-item">
                        <img src="Images/Temp_kidstour_Monaco.jpg" class="d-block w-100" alt="Etape 5">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>
    </main>
    <?php include 'Composant/Footer.php'; ?>
</body>

</html>