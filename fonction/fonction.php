<?php

// ------------------------ Intéraction avec la BDD ------------------------

/**
 * Fonction qui permet de récupérer des informations dans la base de données
 *
 * @param string $info : liste des champs que l'on souhaite récupérer
 * @param string $table : nom de la table dans laquelle l'on souhaite récupérer les informations
 * @param string $type_fetch : type de fetch ("fetchAll" pour récupérer tout, "fetch" pour récupérer un seul résultat)
 * @param string|null $filtre : filtre pour la requête (exemple :"id_etape = 1")
 * @param string|null $trier : champ par lequel on souhaite trier les résultats (exemple : "nom DESC")
 * @param array|null $join : tableaux contenant les jointures (exemple : [['tableBase'=>'etapes', 'tableToJoin' => 'participe', 'lien' => 'id_etape']])
 * 
 *
 * @return array : tableau contenant les résultats de la requête
 */
function obtenirDonnees($info, $table, $type_fetch = 'fetch', $filtre = null, $trier = null, $join = null)
{
    global $bdd;
    try {
        $requete = 'SELECT ' . $info . ' FROM ' . $table;
        if ($join) {
            foreach ($join as $focus) {
                $requete .= ' JOIN ' . $focus['tableToJoin'] . ' ON ' . $focus['tableBase'] . '.' . $focus['lien'] . ' = ' . $focus['tableToJoin'] . '.' . $focus['lien'];
            }
        }
        // Ajouter le filtre à la requête si défini
        if ($filtre) {
            $requete .= ' WHERE ' . $filtre;
        }
        // Ajouter l'ordre de tri à la requête si défini
        if ($trier) {
            $requete .= ' ORDER BY ' . $trier;
        }

        // Préparer et exécuter la requête
        $stmt = $bdd->prepare($requete);
        $stmt->execute();
        // Retourner les résultats en fonction du type de fetch demandé
        return $stmt->$type_fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $requete . "<br>";
        die('Erreur : ' . $e->getMessage());
    }
}

// ------------------------ Récupération de balise HTML ------------------------

/**
 * Fonction qui retourne le metadata commun entre les pages
 *
 * @return string : HTML metadata
 */
function metadata()
{
    return '
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="apple-touch-icon" sizes="180x180" href="Images/favicon.io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="Images/favicon.io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="Images/favicon.io/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="CSS/style.css">
	    <script src="JS/mustache.min.js"></script>
        <script src="JS/script.js"></script>
        
    ';
}


// ------------------------ Action ------------------------

/**
 * Vérifie si l'utilisateur est connecté.
 *
 * Retourne les informations de l'utilisateur si connecté, FALSE sinon.
 *
 * @return true|false : informations de l'utilisateur connecté ou FALSE
 */
function isUserLoggedIn()
{
    startSession();
    return isset($_SESSION['compte']) && $_SESSION['compte'] instanceof Users;
}

/**
 * Démarre une session ou reprend une session existante.
 *
 * Spécifie le nom de la session pour éviter les conflits avec d'autres applications.
 * Configure les paramètres du cookie de session pour une durée de vie de 1 heure.
 * Empêche l'accès au cookie via JavaScript.
 * Empêche l'envoi du cookie via des requêtes intersites.
 * Regénère l'ID de session toutes les 30 minutes pour éviter le vol de session.
 * Vérifie l'inactivité et détruit la session si plus de 1 heure d'inactivité.
 * Met à jour le timestamp de la dernière activité.
 */
function startSession()
{
    // Spécifiez le nom de la session pour éviter les conflits avec d'autres applications
    session_name('ADMIN_SESSION');

    // Configuration des paramètres du cookie de session
    $sessionCookieParams = [
        'lifetime' => 3600,           // Durée de vie de la session : 1 heure (3600 secondes)
        'path' => '/',                // Le cookie est accessible sur tout le site
        'domain' => '',               // Le domaine par défaut (pour tout le domaine actuel)
        'secure' => isset($_SERVER['HTTPS']), // Si le site utilise HTTPS, le cookie n'est envoyé que via HTTPS
        'httponly' => true,           // Empêche l'accès au cookie via JavaScript
        'samesite' => 'Strict'        // Le cookie n'est pas envoyé avec les requêtes intersites
    ];

    session_set_cookie_params($sessionCookieParams);

    // Démarrer la session ou reprendre une session existante
    session_start();

    // Regénérer l'ID de session pour éviter le vol de session
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } elseif (time() - $_SESSION['created'] > 1800) { // Regénère l'ID toutes les 30 minutes
        session_regenerate_id(true);    // Regénère l'ID de session et supprime l'ancien
        $_SESSION['created'] = time();  // Met à jour le timestamp de création
    }

    // Vérifier l'inactivité
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
        // Si plus de 1 heure d'inactivité, détruire la session
        session_unset();     // Supprime toutes les variables de session
        session_destroy();   // Détruit la session
        header("Location: identification.php"); // Redirige vers la page de connexion
        exit();
    }

    // Mettre à jour le timestamp de la dernière activité
    $_SESSION['last_activity'] = time();
}