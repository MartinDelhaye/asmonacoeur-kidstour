<?php
// Déclaration de la classe Etape
class Etapes
{
    private $id_etape;
    private $date_etape;
    private $nom;
    private $description_etape;
    private $lieu_etape;
    private $illustration_etape;
    private $image_etape;
    private $nombre_membres;
    private $liste_invite;

    function __construct($date_etape, $nom, $description_etape, $lieu_etape, $illustration_etape, $image_etape, $nombre_membres, $liste_invite)
    {
        $this->date_etape = $date_etape;
        $this->nom = $nom;
        $this->lieu_etape = $lieu_etape;
        $this->illustration_etape = $illustration_etape;
        $this->image_etape = $image_etape;
        $this->nombre_membres = $nombre_membres;
        $this->liste_invite = $liste_invite;
    }
 /**
     * Méthode statique pour récupérer les invités
     *
     * @param string|null $filtre Filtre pour la requête (exemple :"id_etape = 1")
     * @param string|null $ordre Champ par lequel on souhaite trier les résultats (exemple : "nom DESC")
     *
     * @return array|string Tableau contenant les résultats de la requête ou message d'erreur
     */
    public static function getListeEtapes($filtre = null, $ordre = null) {
        $etapesUsers = obtenirDonnees(
            '*',
            'etapes',
            'fetchAll',
            $filtre,
            $ordre
        );
        if ($etapesUsers) return $etapesUsers;
        return "Aucune étape trouvée";
    }
}
