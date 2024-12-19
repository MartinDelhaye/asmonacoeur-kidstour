<?php

class MembreAssociation extends Users
{
    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
    {
        parent::__construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user);
    }

    public function supprDonnee($table, $key_id, $id)
    {
        global $bdd;
        $aSuppr = obtenirDonnees("*", $table, "fetch", $key_id . "=" . $id);

        $cheminsImagesAsuppr = [];
        if (isset($aSuppr["image_etape"])) {
            $cheminsImagesAsuppr[] = $aSuppr["image_etape"];
        }
        if (isset($aSuppr["illustration_etape"])) {
            $cheminsImagesAsuppr[] = $aSuppr["illustration_etape"];
        }
        if (isset($aSuppr["image_invite"])) {
            $cheminsImagesAsuppr[] = $aSuppr[""];
        }
        foreach ($cheminsImagesAsuppr as $cheminImageAsuppr) {
            if (file_exists($cheminImageAsuppr)) {
                // Supprimer le fichier d'image
                echo "ça supprime une image <br>";
                unlink($cheminImageAsuppr);
            }
        }

        $requete_preparee = $bdd->prepare('DELETE FROM ' . $table . ' WHERE ' . $key_id . ' = ' . $id);
        // Suppression de la bdd
        return $requete_preparee->execute();
    }
}

?>