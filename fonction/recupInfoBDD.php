<?php

/**
 * Fonction qui permet de récupérer des informations dans la base de données
 *
 * @param string $info : liste des champs que l'on souhaite récupérer
 * @param string $table : nom de la table dans laquelle l'on souhaite récupérer les informations
 * @param string $filtre : filtre pour la requête (par exemple, "id_artiste = 1")
 * @param string $trier : champ par lequel on souhaite trier les résultats (par exemple, "nom")
 * @param string $type_fetch : type de fetch (par exemple, "fetchAll" pour récupérer tout, "fetch" pour récupérer un seul résultat)
 *
 * @return array : tableau contenant les résultats de la requête
 */
function obtenirDonnees($info, $table, $type_fetch,  $filtre = '', $trier = '') {
    global $bdd;
    try {
        $requete = 'SELECT ' . $info . ' FROM ' . $table;
        if (!empty($filtre)) {
            $requete .= ' WHERE ' . $filtre;
        }
        if (!empty($trier)) {
            $requete .= ' ORDER BY ' . $trier;
        }
        
        $stmt = $bdd->query($requete);
        return $stmt->$type_fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $requete."<br>";
        die('Erreur : ' . $e->getMessage());
    }
}