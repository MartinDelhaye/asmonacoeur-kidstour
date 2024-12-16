<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

class Users
{
    private $id_user;
    private $login_user;
    private $mdp_user;
    private $nom_user;
    private $prenom_user;

    protected function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
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

    // ------------------------ Connexion ------------------------
    /**
     * Vérifie si un utilisateur peut se connecter
     *
     * @param string $login_user Le login de l'utilisateur
     * @param string $mdp_user   Le mot de passe de l'utilisateur
     *
     * @return Users|string L'utilisateur connecté si la connexion est réussie, un message d'erreur sinon
     */
    public static function connexion($login_user, $mdp_user)
    {
        $user = obtenirDonnees("*", "users", "fetch", "login_user" . " = '$login_user'");

        if ($user && password_verify($mdp_user, $user['mdp_user'])) {
            // Détermine la classe à instancier
            $class = match ($user['type_user']) {
                'membreAssociation', 'superAdmin' => MembreAssociation::class,
                'participant' => Participant::class,
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

    public static function createUser($login_user, $mdp_user, $nom_user, $prenom_user)
    {
        global $bdd;
        if (!$bdd) {
            return 'Erreur : Connexion à la base de données échouée.';
        }
        try {
            $requetePreparee = $bdd->prepare('INSERT INTO users(login_user, mdp_user, nom_user, prenom_user, type_user) VALUES (:login_user, :mdp_user, :nom_user, :prenom_user, :type_user)');
            $requetePreparee->bindValue(':login_user', $login_user, PDO::PARAM_STR);
            $requetePreparee->bindValue(':mdp_user', password_hash($mdp_user, PASSWORD_DEFAULT), PDO::PARAM_STR);
            $requetePreparee->bindValue(':nom_user', $nom_user, PDO::PARAM_STR);
            $requetePreparee->bindValue(':prenom_user', $prenom_user, PDO::PARAM_STR);
            $requetePreparee->bindValue(':type_user', 'participant', PDO::PARAM_STR);

            $resultat = $requetePreparee->execute();
        } catch (Exception $e) {
            return 'Erreur : ' . $e->getMessage();
        }
        if ($resultat) {
            return Users::connexion($login_user, $mdp_user);
        }
        return 'Erreur lors de la création de l’utilisateur';
    }

    public function deconnexion()
    {
        unset($_SESSION['compte']);
    }

    public static function loginExist($login_user)
    {
        $user = obtenirDonnees("*", "users", "fetch", "login_user" . " = '$login_user'");
        if ($user)
            return true;
        return false;
    }

    public function getListeEtapes($filtre = null, $ordre = null)
    {
        $infoSup = "";
        if ($this instanceof MembreAssociation)
            $tableJOIN = "organise";
        else if ($this instanceof Participant) {
            $infoSup = ", participe.nbr_enfant_participe";
            $tableJOIN = "participe";
        } else
            return "Erreur : Type Utilisateur incorrect";

        // Détermine les filtres et ordre
        $filtreRequete = "users.id_user = " . $this->getIdUser();
        if ($filtre)
            $filtreRequete .= " AND $filtre";

        $etapesUsers = obtenirDonnees(

            'etapes.id_etape, etapes.date_etape, etapes.lieu_etape, etapes.nom_etape, etapes.illustration_etape' . $infoSup,
            'etapes',
            'fetchAll',
            $filtreRequete,
            $ordre,
            [
                ['tableBase' => 'etapes', 'tableToJoin' => $tableJOIN, 'lien' => 'id_etape'],
                ['tableBase' => $tableJOIN, 'tableToJoin' => 'users', 'lien' => 'id_user']
            ]
        );
        if ($etapesUsers) {
            return $etapesUsers;
        }
        return false;
    }
}

?>