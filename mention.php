<?php
include_once('fonction/fonction.php');


if (isUserLoggedIn())
  $user = $_SESSION['compte'];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <?php echo metadata(); ?>
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Page d'acceuil</title>

<body>
  <?php include 'Composant/Header.php'; ?>
  <main>
  <!-- Conteneur principal -->
  <div class="container mt-5 p-4 bg-white shadow rounded py-4">
    <!-- Section Identité -->
   <h1 class="text-center text-dark">Mentions legales</h1>
    <div class="mb-4">
      <h2 class="h4 border-bottom pb-2">Identité</h2>
      <p class="mb-1">
        <strong>AS MONACOEUR</strong>
      </p>
      <p class="mb-1">
        <strong>Adresse :</strong> 123 Rue Exemple, 75001 Paris
      </p>
      <p class="mb-1">
        <strong>Téléphone :</strong> 01 23 45 67 89
      </p>
      <p>
        <strong>Email :</strong> <a href="mailto:contact@asmonaco.com">contact@asmonaco.com</a>
      </p>
    </div>

    <!-- Section Hébergement -->
    <div class="mb-4">
      <h2 class="h4 border-bottom pb-2">Hébergement</h2>
      <p class="mb-1">
        <strong>Nom de l'hébergeur :</strong>Infinityfree
      </p>
      <p class="mb-1">
        <strong>Adresse :</strong> 456 Rue Hébergeur, 75002 Paris
      </p>
      <p>
        <strong>Téléphone :</strong> 01 98 76 54 32<br>
        <strong>Site Web :</strong> <a href="https://www.infinityfree.com" target="_blank">infinityfree</a>
      </p>
    </div>

    <!-- Section Propriété Intellectuelle -->
    <div class="mb-4">
      <h2 class="h4 border-bottom pb-2">Propriété Intellectuelle</h2>
      <p>
        Le contenu de ce site (textes, images, logos, etc.) est la propriété exclusive de l'association,
        sauf mention contraire. Toute reproduction, même partielle, est interdite sans l'autorisation écrite
        préalable de l'association.
      </p>
    </div>

    <!-- Section Données Personnelles -->
    <div class="mb-4">
      <h2 class="h4 border-bottom pb-2">Données Personnelles</h2>
      <p>
        Les informations recueillies sur ce site sont utilisées uniquement dans le cadre de son fonctionnement
        et ne seront jamais cédées à des tiers sans votre consentement explicite.
      </p>
    </div>
  </div>
  <?php
  include 'Composant/scrollTopBtn.php';
  include 'Composant/Footer.php';
  ?>
  <!-- Lien vers le JavaScript de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  </main>
</body>
</html>