<?php

class Invites {

    private $id_invite;
    private $nom_invite;
    private $prenom_invite;
    private $description_invite;
    private $image_invite; 
    private $contact_invite;
    private $liste_etapes; 

    public function getIdInvite(){
        return $this->id_invite;
    }

    public function getNomInvite(){
        return $this->nom_invite;
    }

    public function getPrenomInvite(){
        return $this->prenom_invite;
    }

    public function getDescInvite(){
        return $this->description_invite;
    }

    public function getImageInvite(){
        return $this->image_invite;
    }

    public function getContactInvite(){
        return $this->contact_invite;
    }

    public function getListeEtapes(){
        return $this->liste_etapes;
    }


    public function __construct($id_invite){
        $invite = obtenirDonnees("*","invites","fetch","id_invite=".$id_invite);
        if($invite){
            $this->id_invite = $id_invite;
            $this->nom_invite = $invite["nom_invite"];
            $this->prenom_invite = $invite["prenom_invite"];
            $this->description_invite = $invite["description_invite"];
            $this->image_invite = $invite["image_invite"];
            $this->contact_invite = $invite["contact_invite"];
            //$this->liste_etapes = $invite["liste_etapes"];

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

    //récupération des étapes de chaque invités
    /*public function getListeEtapes(){
        $organisateurs = obtenirDonnees(
            'users.nom_user, users.prenom_user, users.id_user',
            'anime',
            'fetchALL',
            "organise.id_etape = " . $this->getIdEtape(),
            null,
            [
                ['tableBase' => 'organise', 'tableToJoin' => 'users', 'lien' => 'id_user']
            ]
        );
        return $organisateurs;
    }*/

    // Méthode statique pour récupérer les étapes
    /*public static function getListeInvites(): array {
        try {
            return obtenirDonnees("*", "invites", 'fetchAll');
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des invités : " . $e->getMessage());
        }
    }*/
}
