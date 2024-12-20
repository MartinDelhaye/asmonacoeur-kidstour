<?php
include_once('config/config.php');
include_once('fonction/fonction.php');
include_once('class/Users.php');
include_once('class/Etapes.php');
include_once('class/MembreAssociation.php');

if (isUserLoggedIn())
    $user = $_SESSION['compte'];

$etape = new Etapes($_GET["id_etape"]);

$nbr_enfant = $etape->getNombreParticipant();

$tabOrganisateur = $etape->getListeOrganisateur();

$tabInvites = $etape->getListeInvites();

$tabListeAutreEtape = $etape->getListeAutreEtape();

// récupération des données //
$date_etape = $etape->getDateEtape();
$nom_etape = $etape->getNomEtape();
$description_etape = $etape->getDescEtape();
$lieu_etape = $etape->getLieuEtape();
$illustration_etape = $etape->getIlluEtape();
$image_etape = $etape->getImageEtape();
$ville_etape = $etape->getVilleEtape();
$heure_etape = $etape->getHeureEtape();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo metadata(); ?>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>Etape</title>
</head>

<body>
    <?php include 'Composant/Header.php'; ?>
    <main>
        <div class="container">
            <div class="text-center">
                <h1 class="fw-bold titre1 invite1"><?php echo $nom_etape; ?></h1>
                <img src="<?php echo $image_etape; ?>" alt="Enfant Jouant" class="img-fluid event-image">
            </div>
        </div>

        <div class="container">
            <div class="section-details text-start mt-3">
                <p><span>Organisateur :</span>
                    <?php foreach ($tabOrganisateur as $organisateur) {
                        if (isset($listeOragnisateur)) {
                            $listeOragnisateur .= ", " . $organisateur['nom_user'] . " " . $organisateur['prenom_user'];
                        } else
                            $listeOragnisateur = $organisateur['nom_user'] . " " . $organisateur['prenom_user'];
                    }
                    echo $listeOragnisateur
                        ?>
                </p>
                <p><span>Invités :</span>
                    <?php foreach ($tabInvites as $invite) {
                        if (isset($listeInvites)) {
                            $listeInvites .= ", <a class='lienInvite' href='invite.php?id_invite=" . $invite['id_invite'] . "'>" . $invite['nom_invite'] . " " . $invite['prenom_invite'] . "</a>";
                        } else
                            $listeInvites = "<a class='lienInvite' href='invite.php?id_invite=" . $invite['id_invite'] . "'>" . $invite['nom_invite'] . " " . $invite['prenom_invite'] . "</a>";

                    }
                    echo $listeInvites
                        ?>
                </p>
                <p><span>Horaire :</span> <?php echo $heure_etape; ?></p>
            </div>
        </div>

        <div class="container">
            <div class="row align-items-center my-4">
                <div class="col-md-6 text-center">
                    <img src="<?php echo $illustration_etape; ?>" alt="Illustration Kids Tour"
                        class="img-fluid illustration-image">
                </div>
                <div class="col-md-6 section-description">
                    <p><?php echo $description_etape; ?></p>
                </div>
            </div>
        </div>
        <div class="container img-fluid">

        <?php if (!isset($user)): ?>
           <div class="text-center  rounded shadow">
            <p>Inscrivez-vous pour participer a cette evenement</p>
            <a class="text-center" href="connexion.php">Connexion/Inscription
        <img src="images/icone.png" alt="Icône de connexion" width="30px" title="Connexion">
    </a>
    </div>
<?php elseif ($user instanceof MembreAssociation): ?>
    <button type="submit" class="btn btn-danger w-50 text-center">Organiser</button>
<?php elseif ($user instanceof Participant): ?>
    <button type="submit" class="btn btn-danger w-50 text-center">Participer</button>
    <div class="mb-3">
        <label for="nombre_enfants" class="form-label">Nombre d'enfant que vous voulez inscrire</label>
        <input type="text" id="nombre_enfants" name="nombre_enfants" class="form-control w-50 text-center" placeholder="Nombre d'enfant" required>
    </div>
<?php endif; ?>





        </div>




        <!-- Carousel Images à changer-->
        <div class="container">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php for ($i = 0; $i < count($tabListeAutreEtape); $i++): ?>
                        <a href="etape.php?id_etape=<?php echo $tabListeAutreEtape[$i]["id_etape"] ?>">
                            <div class="carousel-item <?php if ($i == 0)
                                echo 'active' ?>">
                                    <img class="d-block img-fluid rounded shadow p-3 mb-5 mx-auto"
                                        src="<?php echo $tabListeAutreEtape[$i]["image_etape"] ?>" class="d-block w-100"
                                    alt="Etape 2">
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
    <?php include 'Composant/Footer.php'; 
     include 'Composant/scrollTopBtn.php';
    ?>
</body>

</html>