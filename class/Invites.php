<?php
class invite {

    private $id_invite;
    private $nom_invite;
    private $prenom_invite;
    private $desciption_invite;
    private $contact_invite;
    private $liste_etapes; 
}

 public function __construct($id_invite, $nom_invite, $prenom_invite, $desciption_invite, $contact_invite, $liste_etapes) {
    $this->id_invite = $id_invite;
    $this->nom_invite = $nom_invite;
    $this->prenom_invite = $prenom_invite;
    $this->desciption_invite = $desciption_invite;
    $this->contact_invite = $contact_invite;
    $this->liste_etapes = $liste_etapes;
}


function Invite() {
}

?>