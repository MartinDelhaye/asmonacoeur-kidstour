<?php
// Déclaration de la classe Etape
class Etapes {
    private $id_etape;
    private $date_etape;
    private $nom;
    private $description_etape;
    private $lieu_etape;
    private $illustration_etape;
    private $image_etape;
    private $nombre_membres;
    private $liste_invite;

function __construct($date_etape,$nom,$description_etape,$lieu_etape,$illustration_etape,$image_etape,$nombre_membres,$liste_invite){
    $this->date_etape = $date_etape;
    $this->nom = $nom;  
    $this->description_etape = $description_etape;
    $this->lieu_etape = $lieu_etape;
    $this->illustration_etape = $illustration_etape;
    $this->image_etape = $image_etape;
    $this->nombre_membres = $nombre_membres;
    $this->liste_invite = $liste_invite;
}


}
// function Anime(){
// }

?>
