<?php

class Invites {

    private $id_invite;
    private $nom_invite;
    private $prenom_invite;
    private $description_invite;
    private $contact_invite;
    private $liste_etapes; 

    public function __construct($id_invite, $nom_invite, $prenom_invite, $description_invite, $contact_invite, $liste_etapes) {
        $this->id_invite = $id_invite;
        $this->nom_invite = $nom_invite;
        $this->prenom_invite = $prenom_invite;
        $this->description_invite = $description_invite;
        $this->contact_invite = $contact_invite;
        $this->liste_etapes = $liste_etapes;
    }

    /**
     * Méthode statique pour récupérer les invités
     *
     * @param string|null $filtre Filtre pour la requête (exemple :"id_etape = 1")
     * @param string|null $ordre Champ par lequel on souhaite trier les résultats (exemple : "nom DESC")
     *
     * @return array|string Tableau contenant les résultats de la requête ou message d'erreur
     */
    public static function getListeInvites($filtre = null, $ordre = null) {
        $etapesUsers = obtenirDonnees(
            '*',
            'invites',
            'fetchAll',
            $filtre,
            $ordre
        );
        if ($etapesUsers) return $etapesUsers;
        return "Aucun invité trouvé";
    }
}
