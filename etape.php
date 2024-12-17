<?php
    $tabInfoEtape = 
    ["date_etape" => "2023-11-03",
    "lieu_etape"=>"2 Pl. de la République, 83440 Fayence",
    "nom_etape"=>"Le Kids Tour et Aleksandr Golovin à Fayence ce vendredi",
    "description_etape"=>"Rendez-vous à la mairie.
    Pour cette étape de l’A...",
    "illustration_etape"=>"Images/Temp_kidstour_Complet.jpg",
    "image_etape"=>"Images/Temp_kidstour_img_enfant1.jpg",
    "ville_etape"=>"Fayence",
    "heure_etape"=>"13h30 - 17h30",
    "id_etape" =>"1"];

    $tabOrganisateur = [
        ["nom_user" => "Delhaye",
        "prenom_user"=>"Martin",
        "id_user" =>"1"],
        ["nom_user" => "Madec",
        "prenom_user"=>"Charlotte",
        "id_user" =>"2"],
        ["nom_user" => "Couragier",
        "prenom_user"=>"Mathis",
        "id_user" =>"3"]
    ];

    $tabInvites = [
        ["nom_invite" => "Balogun",
        "prenom_invite"=>"Folarin",
        "id_invite" =>"1"],
        ["nom_invite" => "Golovin",
        "prenom_invite"=>"Aleksandr",
        "id_invite" =>"2"],
        ["nom_invite" => "Minamino",
        "prenom_invite"=>"Takumi",
        "id_invite" =>"3"]
    ];

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
<?php include 'Composant/Header.php'; ?>

<section class="contenuEtape">
    <div class="container">
        <div class="row text-center">
            <div class="nomEtape text-danger">
                <h1><?php echo $tabInfoEtape["nom_etape"];?></h1>
            </div>
            <div>
                <?php echo $tabInfoEtape["image_etape"];?>
            </div>
        </div>
        <div>
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="row">
                        <p><span>Organisateur :</span> <?php  
                            foreach($tabOrganisateur as $organisateur){
                            echo $organisateur["nom_user"]." ". $organisateur["prenom_user"];
                            }
                        ?> </p>
                    </div>
                    <div class="row">
                        <p><span>Invités :</span> <?php  
                            foreach($tabInvites as $invite){
                                echo "<a href=''> ". $invite["nom_invite"]." ". $invite["prenom_invite"]."</a> ";
                            }
                        ?> </p>
                    </div>
                    <div class="row">
                        <p><span>Horaire :</span> <?php echo $tabInfoEtape["heure_etape"];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?php echo $tabInfoEtape["illustration_etape"];?>
            </div>
            <div class="col-md-6">
                <p><?php echo $tabInfoEtape["description_etape"];?></p>
            </div>
        </div>
    </div>

</section>





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
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>



</body>
</html>