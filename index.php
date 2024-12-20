<?php
include_once('fonction/fonction.php');
include_once('class/Users.php');

if(isUserLoggedIn()) $user = $_SESSION['compte'];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <?php echo metadata(); ?>
  <meta name="keywords" content="AS Monacoeur, AS Monacoeur, Kids Tour, football amateur, enfants AS Monaco, valeurs solidarité sport, Monaco Kids Tour, saison 2023-2024, animations football, événement AS Monaco">
  <meta name="description" content="Découvrez l'AS Monacoeur Kids Tour, un programme pour les enfants mêlant football amateur, animations familiales et valeurs de solidarité à travers la saison 2023-2024.">
  <title>Page d'acceuil</title>
</head>
<body>
  <?php include 'Composant/Header.php'; ?>
  <main>
    <div class="position-relative">
      <div class="bande-rouge img-fluid mx-auto ">
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-white fs-2">
          <p>AS Monacoeur Kids Tour</p>
        </div>
      </div>
    </div>
    </div>
    <section class="container my-5">
      <div class="row align-center">
        <!-- Colonne Image -->
        <div class="col-md-6">
          <img src="images/Temp_kidstour_img_enfant4.jpg" alt="Image principale" class="img-fluid rounded shadow">
        </div>
        <!-- Colonne Texte -->
        <div class="col-md-6">
          <p>
            L'AS Monacoeur qui entame sa 4ème saison d'existence, est un programme d'actions avec et pour les enfants,
            qui
            se veut au plus près du football amateur,
            des écoles, des institutions et du tissu associatif local.

            Il œuvre au développement de valeurs de solidarité et de partage en plaçant les enfants au cœur de ses
            activités.
            Soucieux de diffuser un message positif en utilisant le sport et de s’engager en faveur des générations
            futures,
            l’AS Monacoeur entend aussi à terme s’impliquer comme acteur éco-responsable.
          </p>
        </div>
      </div>
    </section>
    <!-- Autre Section Texte + Image -->
    <section class="container my-5">
      <div class="row justify-content-center text-center">
        <!-- Colonne Image -->
        <!-- Texte en dessous -->
        <div class="col-md-8 mt-4">
          <h2 class="fw-bold text-danger">Saison 2023-2024</h2>
          <p>

            Après le retour de la Munegu Family au Stade Louis-II (compétition de football entre écoles monégasques),
            l’AS Monaco poursuit ses initiatives à destination des plus jeunes et des familles.
            Le premier Monaco Kids Tour a eu lieu, regroupant plus de 3400 enfants lors de 31 étapes,
            ce tour a permis de faire profiter gratuitement de nombreux jeunes dans des activités et animation proposées
            par le Club.
            L’occasion d’être immergé dans le club de football à travers de nombreux invités présents aux événements
            comme
            le joueur Myron Boadu.
          </p>
        </div>
        <div class="col-md-8  ">
          <img src="images/kidtour.jpg" alt="Deuxième image" class="img-fluid rounded shadow">
        </div>
        <p class="mt-4">
          Pour l’année 2024-2025, l’AS Monacoeur revient pour un nouveau parcours préparant de nouvelles surprises en
          collaboration avec les mairies,
          les centres de loisirs, etc, présents sur la route.
          2000 km de voyages, 16 participations de joueurs, 26 communes, 3 pays, 100% de sourires et de bonne humeur !
          C’est le moment de découvrir le Kids Tour Monaco et de plonger dans l’esprit du Club. 

          Le parcours Kids Tour 2023-2024 prend le départ de Dolceacqua en Italie jusqu’à La-Londe-les-Maures dans le
          Var
          en passant par Roquebrune-Cap-Martin,
          Sospel, Auron, Peymeinade ou bien encore Fayence. Si la plupart des étapes vont être effectuées en France dans
          le département des Alpes-Maritimes,
          la caravane Rouge & Blanche va également réaliser cinq étapes dans le Var et deux en Italie.
          Sans oublier ses passages en Principauté où trois lieux emblématiques vont les accueillir : le Musée
          océanographique,
          le port Hercule et naturellement le parvis du Stade Louis-II en marge de plusieurs rencontres du Club. 
      </div>
    </section>
  </main>
  <?php 
  include 'Composant/scrollTopBtn.php';
  include 'Composant/Footer.php'; 
  ?>
</body>
</html>