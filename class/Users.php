<?php

class Users
{
    private $id_user;
    private $login_user;
    private $mdp_user;
    private $nom_user;
    private $prenom_user;

    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
    {
        $this->id_user = $id_user;
        $this->login_user = $login_user;
        $this->mdp_user = $mdp_user;
        $this->nom_user = $nom_user;
        $this->prenom_user = $prenom_user;
    }

    // ------------------------ Getters ------------------------

    public function getIdUser()
    {
        return $this->id_user;
    }
    public function getLoginUser()
    {
        return $this->login_user;
    }
    public function getNomUser()
    {
        return $this->nom_user;
    }
    public function getPrenomUser()
    {
        return $this->prenom_user;
    }

    // ------------------------ Méthode de connexion ------------------------

    public static function connexion($login_user, $mdp_user)
    {
        $user = obtenirDonnees("*", "users", "fetch", "login_user" . " = '$login_user'");

        if ($user && password_verify($mdp_user, $user['mdp_user'])) {
            // Déterminez la classe à instancier
            $class = match ($user['type_user']) {
                'admin', 'superAdmin' => Admin::class,
                'membre' => Membre::class,
            };

            // Instanciation dynamique de la classe correcte
            $connectedUser = new $class(
                $user['id_user'],
                $user['login_user'],
                $user['mdp_user'],
                $user['nom_user'],
                $user['prenom_user']
            );
            return $connectedUser;
        }
        return 'Login ou Mot de passe incorrect'; // Connexion échouée
    }
}

class Membre extends Users
{
    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
    {
        parent::__construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user);
    }
}

class Admin extends Users
{
    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
    {
        parent::__construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user);
    }
}


?>