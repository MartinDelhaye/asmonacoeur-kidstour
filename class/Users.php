<?php

spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
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
    public function supprimerCompte()
    {
        global $bdd;
        $requetePreparee = $bdd->prepare('DELETE FROM users WHERE id_user = :id_user');
        $requetePreparee->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $resultat = $requetePreparee->execute();
        return $resultat;
    }

    public static function loginExist($login_user)
    {
        $user = obtenirDonnees("*", "users", "fetch", "login_user" . " = '$login_user'");
        if ($user)
            return true;
        return false;
    }
    public function ModifierCompte($nvNom_user, $nvPrenom_user,$nvLogin_user)
    {
        global $bdd;
    
        // Vérifier que les champs ne sont pas vides
        if (empty($nvNom_user) || empty($nvPrenom_user)) {
            return "Les champs nom et prénom ne peuvent pas être vides.";
        }
    
        // Préparer la requête pour mettre à jour les informations du compte
        $requete_prepare = $bdd->prepare(
            'UPDATE users 
             SET nom_user = :nom_user, 
                 login_user = :login_user, 
                 prenom_user = :prenom_user 
             WHERE id_user = :id_user'
        );
        $requete_prepare->bindValue(':nom_user', $nvNom_user, PDO::PARAM_STR);
        $requete_prepare->bindValue(':prenom_user', $nvPrenom_user, PDO::PARAM_STR);
        $requete_prepare->bindValue(':login_user', $nvLogin_user, PDO::PARAM_STR);
        $requete_prepare->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
    
        // Exécuter la requête et vérifier le succès
        if ($requete_prepare->execute()) {
            $this->nom_user = $nvNom_user;
            $this->login_user = $nvLogin_user;
            $this->prenom_user = $nvPrenom_user;
    
    
            return "Informations du compte modifiées avec succès.";
        } else {
            return "Une erreur est survenue lors de la mise à jour des informations.";
        }
    }

    public function Modifmdp($mdp_user, $nw_mdp, $confirm_mdp)
{
    global $bdd;

    // Vérifier que le mot de passe actuel est correct
    if (!password_verify($mdp_user, $this->mdp_user)) {
        return "Le mot de passe actuel est incorrect.";
    }

    // Vérifier que les champs ne sont pas vides
    if (empty($nw_mdp) || empty($confirm_mdp)) {
        return "Les champs de nouveau mot de passe et de confirmation ne peuvent pas être vides.";
    }

    // Vérifier que le nouveau mot de passe et la confirmation correspondent
    if ($nw_mdp !== $confirm_mdp) {
        return "Les nouveaux mots de passe ne correspondent pas.";
    }

    // Préparer la requête pour mettre à jour le mot de passe
    $requete_prepare = $bdd->prepare('UPDATE users SET mdp_user = :mdp_user WHERE id_user = :id_user');
    $requete_prepare->bindValue(':mdp_user', password_hash($nw_mdp, PASSWORD_DEFAULT), PDO::PARAM_STR);
    $requete_prepare->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);

    // Exécuter la requête et vérifier le succès
    if ($requete_prepare->execute()) {
        return "Mot de passe modifié avec succès.";
    } else {
        return "Une erreur est survenue lors de la mise à jour du mot de passe.";
    }
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

        // Détermine les filtres 
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
        if ($etapesUsers) return $etapesUsers;
        return "Aucune étape trouvée";
    }
}

?>