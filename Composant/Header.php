<!-- Header -->
<header>
  <nav class="navbar fixed-top">
    <div class="container-fluid">
      <span class="mx-auto">
        <a href="index.php" class="Titre  text-center fs-2"><h1>AS MONACOEUR</h1></a>
      </span>
      <button class="navbar-toggler bg-body-tertiary" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="etapes.php">Étapes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="invites.php">Invités</a>
            </li>
            <?php if (isset($user) && $user instanceof Users): ?>
              <li class="nav-item"><a class="nav-link" href="compte.php">Compte<img src="images/icone.png"></a></li>
              <li class="nav-item"><a class="nav-link" href="deconnecter.php">Se déconnecter</a></li>
            <?php else: ?>
              <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connexion/Inscription<img src="images/icone.png" alt="icone"
                    title="Connexion"></a>
              </li>
            </ul>
          <?php endif; ?>
          <form class="d-flex mt-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Recherche</button>
          </form>
        </div>
      </div>
    </div>
  </nav>
</header>