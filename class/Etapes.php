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
    private $ville_etape;
    private $heure_etape;
    private $nombre_membres;
    private $liste_invite;

    // récupération des données //
    public function getIdEtape(){
        return $this->id_etape;
    }

    public function getDateEtape(){
        return $this->date_etape;
    }

    public function getNomEtape(){
        return $this->nom_etape;
    }

    public function getDescEtape(){
        return $this->description_etape;
    }

    public function getLieuEtape(){
        return $this->lieu_etape;
    }

    public function getIlluEtape(){
        return $this->illustration_etape;
    }

    public function getImageEtape(){
        return $this->image_etape;
    }

    public function getVilleEtape(){
        return $this->ville_etape;
    }

    public function getHeureEtape(){
        return $this->heure_etape;
    }


    public function __construct($id_etape){
        $etape = obtenirDonnees("*","etapes","fetch","id_etape=".$id_etape);
        if($etape){
            $this->id_etape = $id_etape;
            $this->date_etape = $etape["date_etape"];
            $this->nom_etape = $etape["nom_etape"];
            $this->lieu_etape = $etape["lieu_etape"];
            $this->description_etape = $etape["description_etape"];
            $this->illustration_etape = $etape["illustration_etape"];
            $this->image_etape = $etape["image_etape"];
            $this->ville_etape = $etape["ville_etape"];
            $this->heure_etape = $etape["heure_etape"];

        }
    }

    public function getNombreParticipant(){
        $nbrParticipant = obtenirDonnees("SUM(participe.nbr_enfant_participe)", "participe", "fetch", "id_etape =".$this->id_etape);
        return $nbrParticipant;
    }

    public function getListeInvites(){
        $invites = obtenirDonnees(
            'invites.nom_invite, invites.prenom_invite, invites.id_invite',
            'anime',
            'fetchALL',
            "anime.id_etape = " . $this->getIdEtape(),
            null,
            [
                ['tableBase' => 'anime', 'tableToJoin' => 'invites', 'lien' => 'id_invite']
            ]
        );
        return $invites;
    }
    

    public function getListeOrganisateur(){
        $organisateurs = obtenirDonnees(
            'users.nom_user, users.prenom_user, users.id_user',
            'organise',
            'fetchALL',
            "organise.id_etape = " . $this->getIdEtape(),
            null,
            [
                ['tableBase' => 'organise', 'tableToJoin' => 'users', 'lien' => 'id_user']
            ]
        );
        return $organisateurs;
    }

    // Méthode statique pour récupérer les étapes
    public static function getListeEtapes(): array {
        try {
            return obtenirDonnees("*", "etapes", 'fetchAll');
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des étapes : " . $e->getMessage());
        }
    }

 /**
     * Méthode statique pour récupérer les invités
     *
     * @param string|null $filtre Filtre pour la requête (exemple :"id_etape = 1")
     * @param string|null $ordre Champ par lequel on souhaite trier les résultats (exemple : "nom DESC")
     *
     * @return array|string Tableau contenant les résultats de la requête ou message d'erreur
     */
    /*public static function getListeEtapes($filtre = null, $ordre = null) {
        $etapesUsers = obtenirDonnees(
            '*',
            'etapes',
            'fetchAll',
            $filtre,
            $ordre
        );
        if ($etapesUsers) return $etapesUsers;
        return "Aucune étape trouvée";
    }*/
}
