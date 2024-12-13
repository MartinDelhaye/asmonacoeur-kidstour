<?php 

class Participant extends Users
{
    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
    {
        parent::__construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user);
    }
}

?>