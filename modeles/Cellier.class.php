<?php
/**
 * Class Utilisateur
 * Cette classe possède les fonctions de gestion des celliers.
 * @author Guillaume Landry
 * @version 1.0
 * @update 2020-09-14
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Cellier extends Modele {
    const TABLE = 'vino__cellier';

    /**
	 * Fonction: Permetant de montrer tous les bouteilles qui sont dans des celliers
	 * 
	 * @param $idUtilisateur est le id de l'utilisateur que tu souhaite ajouter un cellier
     * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return boo de tous les bouteilles du cellier
	 */
    public function ajouterCellier($idUtilisateur){
        $this->stmt = $this->_db->prepare("INSERT INTO  vino__cellier(fk__users_id) VALUES (?);");
        $this->stmt->bind_param('i', $idUtilisateur);
        if($this->stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

}