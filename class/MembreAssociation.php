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
                unlink($cheminImageAsuppr);
            }
        }

        $requete_preparee = $bdd->prepare('DELETE FROM ' . $table . ' WHERE ' . $key_id . ' = :id');
        $requete_preparee->bindParam(':id', $id, PDO::PARAM_INT);
        // Suppression de la bdd
        if($requete_preparee->execute()) return "Données supprimées";
        return false;
    }
    public function modifierElement($table, $id, $data, $files) {
        global $bdd;
    
        $getter = [];
        switch ($table) {
            case 'invites':  
                $class = Invites::class;
                $key_id = 'id_invite';
                $getter = [
                    'nom_invite' => 'getNomInvite',
                    'prenom_invite' => 'getPrenomInvite',
                    'description_invite' => 'getDescInvite',
                    'contact_invite' => 'getContactInvite'
                ];
                $getterimage = [
                    'image_invite' => 'getImageInvite'
                ];
                break;
            case 'etapes':
                $class = Etapes::class;
                $key_id = 'id_etape';
                $getter = [
                    'nom_etape' => 'getNomEtape',
                    'description_etape' => 'getDescEtape',
                    'date_etape' => 'getDateEtape',
                    'heure_etape' => 'getHeureEtape',
                    'lieu_etape' => 'getLieuEtape',
                    'ville_etape' => 'getVilleEtape',
                ];
                $getterimage = [
                    'image_etape' => 'getImageEtape',
                    'illustration_etape' => 'getIlluEtape'
                ];
                break;
            default:
                return "Type invalide";
        }
    
        // Création de l'objet pour accéder aux données existantes
        $objet = new $class($id);
        $modifications = [];
    
        // Vérification des modifications pour chaque champ
        foreach ($getter as $key => $method) {
            if (method_exists($objet, $method) && $objet->$method() !== $data[$key]) {
                $modifications[$key] = $data[$key];
            }
        }
    
        // Gestion des fichiers téléchargés
        if (!empty($files)) {
            foreach ($files as $key => $file) {
                if ($file['error'] === UPLOAD_ERR_OK) {
                    // Créer un nom unique pour l'image pour éviter les collisions
                    $newFileName = $id . '_' . basename($file['name']);
    
                    // Déplacer l'image téléchargée vers le dossier final
                    $newPath = 'images/' . $newFileName;
                    if (move_uploaded_file($file['tmp_name'], $newPath)) {
                        // Ajouter le chemin de l'image au tableau des modifications
                        $modifications[$key] = $newPath;
                        if (isset($getterimage[$key]) && method_exists($objet, $getterimage[$key])) {
                            $currentImagePath = $objet->{$getterimage[$key]}(); // Récupérer le chemin de l'image existante
                            if ($currentImagePath && file_exists($currentImagePath)) {
                                unlink($currentImagePath); // Supprimer l'image existante
                            }
                        }
                    } else {
                        return "Erreur lors du téléchargement de l'image.";
                    }
                }
            }
        }
    
        // Si aucune modification n'a été détectée
        if (empty($modifications)) {
            return "Aucune donnée modifiée";
        }
    
        // Préparer la requête SQL pour mettre à jour les données
        $setPrepare = [];
        foreach ($modifications as $key => $value) {
            $setPrepare[] = "$key = :$key";
        }
        $setPrepare = join(', ', $setPrepare);
    
        $query = "UPDATE $table SET $setPrepare WHERE $key_id = :id";
        $requete_preparee = $bdd->prepare($query);
    
        // Lier les valeurs des modifications
        foreach ($modifications as $key => $value) {
            $requete_preparee->bindValue(':' . $key, $value);
        }
        $requete_preparee->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Exécuter la requête
        $res = $requete_preparee->execute();
        if ($res) {
            return "Données modifiées";
        }
        return "Échec de la mise à jour";
    }

    public function ajouterInvite($nom, $prenom, $description, $contact, $image) {
        global $bdd;
        $query = "INSERT INTO invites (nom_invite, prenom_invite, description_invite, contact_invite, image_invite)
                  VALUES (:nom, :prenom, :description, :contact, :image)";
        
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':image', $image);
        
        return $stmt->execute();
    }

    public function ajouterEtape($nom, $description, $date, $heure, $lieu, $ville, $image, $illustration) {
        global $bdd;
        $query = "INSERT INTO etapes (nom_etape, description_etape, date_etape, heure_etape, lieu_etape, ville_etape, image_etape, illustration_etape)
                  VALUES (:nom, :description, :date, :heure, :lieu, :ville, :image, :illustration)";
        
        $stmt = $bdd->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':heure', $heure);
        $stmt->bindParam(':lieu', $lieu);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':illustration', $illustration);
        
        return $stmt->execute();
    }
}
?>