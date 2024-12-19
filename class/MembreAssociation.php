<?php

class MembreAssociation extends Users
{
    public function __construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user)
    {
        parent::__construct($id_user, $login_user, $mdp_user, $nom_user, $prenom_user);
    }

    public function supprimerDonnees($table, $key_id, $id)
    {
        global $bdd;
        $aSuppr = obtenirDonnees("*", $table, "fetch", $key_id . "=" . $id);
        if(!$aSuppr) return false;

        $cheminsImagesAsuppr = [];
        if (isset($aSuppr["image_etape"])) {
            $cheminsImagesAsuppr[] = $aSuppr["image_etape"];
        }
        if (isset($aSuppr["illustration_etape"])) {
            $cheminsImagesAsuppr[] = $aSuppr["illustration_etape"];
        }
        if (isset($aSuppr["image_invite"])) {
            $cheminsImagesAsuppr[] = $aSuppr["image_invite"];
        }
        foreach ($cheminsImagesAsuppr as $cheminImageAsuppr) {
            if (!empty($cheminImageAsuppr) &&file_exists($cheminImageAsuppr)) {
                // Supprimer le fichier d'image
                echo "ça supprime une image <br>";
                unlink($cheminImageAsuppr);
            }
        }

        $requete_preparee = $bdd->prepare('DELETE FROM ' . $table . ' WHERE ' . $key_id . ' = ' . $id);
        // Suppression de la bdd
        if($requete_preparee->execute()) return "Données supprimées";
        return false;
    }
}

?>