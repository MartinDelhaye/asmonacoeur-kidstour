<?php


class Users
{
    private $id_user;
    private $login_user;
    private $mdp_user; 
    private $nom_user;  
    private $prenom_user;  

    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user) {
        $this->id_user = $id_user;
        $this->login_user = $login_user;
        $this->mdp_user = $mdp_user;
        $this->nom_user = $nom_user;
        $this->prenom_user = $prenom_user;
    }


    // ------------------------ Methode pour la connexion ------------------------ 
    public function connexion($login_user, $mdp_user) {

        $user = obtenirDonnees("*", "users", "fetch", "login_user"." = '$login_user'");
    
        if ($user && password_verify($mdp_user, $user['mdp_user'])) {
            $connectedUser = new Users(
                $user['id_user'],
                $user['login_user'],
                $user['mdp_user'],
                $user['nom_user'],
                $user['prenom_user']
            );

            return $connectedUser;

        } else {
            return false; // Connexion échouée
        }
    }

    public function getIdUser()
    {
        return $this->id_user;
    }
}


    
