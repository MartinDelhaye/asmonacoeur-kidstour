<?php

// ------------------------ Intéraction avec la BDD ------------------------

/**
 * Fonction qui permet de récupérer des informations dans la base de données
 *
 * @param string $info : liste des champs que l'on souhaite récupérer
 * @param string $table : nom de la table dans laquelle l'on souhaite récupérer les informations
 * @param string|null $filtre : filtre pour la requête (exemple :"id_artiste = 1")
 * @param string|null $trier : champ par lequel on souhaite trier les résultats (exemple : "nom DESC")
 * @param string $type_fetch : type de fetch ("fetchAll" pour récupérer tout, "fetch" pour récupérer un seul résultat)
 *
 * @return array : tableau contenant les résultats de la requête
 */
function obtenirDonnees($info, $table, $type_fetch = 'fetch', $filtre = null, $trier = null)
{
    global $bdd;
    try {
        $requete = 'SELECT ' . $info . ' FROM ' . $table;
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
    ';
}
