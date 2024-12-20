<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Invites.php');

if(isUserLoggedIn()) $user = $_SESSION['compte'];

$invite = new Invites($_GET["id_invite"]);

$tabAnime = $invite->getListeEtapes();

$tabInvites = $invite->getListeInvites();

$tabListeAutreInvite = $invite->getListeAutreInvite();

// récupération des données //
$id_invite = $invite->getIdInvite();
$nom_invite = $invite->getNomInvite();
$prenom_invite = $invite->getPrenomInvite();
$description_invite = $invite->getDescInvite();
$image_invite = $invite->getImageInvite();
$contact_invite = $invite->getContactInvite();

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
                <img class="rounded shadow" src="<?php echo $image_invite; ?>" alt="Joueur de foot">
            </div>
        </div>

        <div class="container nomContact">
            <?php if (isset($user)): 
                echo $contact_invite; 
            endif; ?>
        </div>

        <div class="container">
            <div class="row align-items-center my-4">
                <div class="col-12 section-description">
                    <p><?php echo $description_invite; ?></p>
                </div>
            </div>
        </div>

        <div class="container boxLienEtape">
            <p><div class="text-center nomLienEtape"><span>Liste des Etapes :</span><br></div>
                <br />
                <?php foreach ($tabAnime as $etape) {
                    echo "<a class='lienEtape text-decoration-underline' href='etape.php?id_etape=".$etape['id_etape']."'>".$etape['ville_etape'] . " | " . $etape['heure_etape'] . " | " . $etape['nom_etape']."</a><br>";

                } 
                ?>
            </p>
        </div>
        

        <!-- Carousel Images à changer--> 
        <div class="container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php for($i=0; $i <count($tabListeAutreInvite); $i++) : ?>
                        <a href="invite.php?id_invite=<?php echo $tabListeAutreInvite[$i]["id_invite"]?>">
                            <div class="carousel-item <?php if($i==0)echo'active'?>">
                                <img class="d-block img-fluid rounded shadow p-3 mb-5 mx-auto" src="<?php echo $tabListeAutreInvite[$i]["image_invite"]?>" class="d-block w-100" alt="Etape 2">
                            </div>
                        </a>
                    <?php endfor; ?>
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