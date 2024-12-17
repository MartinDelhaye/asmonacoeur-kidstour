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

    // Méthode statique pour récupérer les invités
    public static function getListeInvites(): array {
        try {
            return obtenirDonnees("*", "invites", 'fetchAll');
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des invités : " . $e->getMessage());
        }
    }
}
