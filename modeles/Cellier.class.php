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
    public function ajouterCellier($idUtilisateur, $cellier__nom){
        $this->stmt = $this->_db->prepare("INSERT INTO  vino__cellier(fk__users_id,cellier__nom) VALUES (?,?);");
        $this->stmt->bind_param('is', $idUtilisateur, $cellier__nom);
        if($this->stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

     /**
	 * Fonction: Permetant d'aller chercher un cellier d'un utilisateur
	 * 
	 * @param $idCellier est le id du cellier 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return boo de tous les bouteilles du cellier
	 */
    public function getUnCellier($idCellier){
         //Initialise l'array rows
         $rows = Array();

         //Créer la requete
         $requete="SELECT * FROM vino__cellier WHERE id = " . $idCellier;
 
         if(($res = $this->_db->query($requete)) ==	 true)
         {
             if($res->num_rows)
             {
                 while($row = $res->fetch_assoc())
                 {
                     $row['id'] = trim(utf8_encode($row['id']));
                     $rows[] = $row;
                 }
             }
         }
         else 
         {
             throw new Exception("Erreur de requête sur la base de donnée", 1);
             //$this->_db->error;
         }
         return $rows;
     }

     /**
	 * Fonction: Permetant de supprimer le cellier d'un utilisateur
	 * 
	 * @param $idCellier est le id du cellier 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return boo de tous les bouteilles du cellier
	 */
    public function supprimerCellier($idCellier, $idUtilisateur){
        try {
            // First of all, let's begin a transaction
            $this->_db->begin_transaction() ;
            
            //Créer la 1er requete
            $this->stmt = $this->_db->prepare("DELETE FROM cellier__bouteille WHERE vino__cellier_id = ?");
            //Bind les params
            $this->stmt->bind_param('i', $idCellier);
            $this->stmt->execute();


            //Créer la 2e requete
            $this->stmt = $this->_db->prepare("DELETE FROM vino__cellier WHERE id = ? AND fk__users_id = ?");

            //Bind le param
            $this->stmt->bind_param('ii', $idCellier, $idUtilisateur );
            $this->stmt->execute();

            
            // Commit de la transaction si aucune erreur
            $this->_db->commit();
            return true;
        } catch (\Throwable $e) {
            
            //Une erreur est survenue donc, on doit rollbacck
            $this->_db->rollback();
            throw $e; 
        }
    }

    /**
	 * Fonction: Permetant de montrer tous les bouteilles qui sont dans des celliers
	 * 
	 * @param $idUtilisateur est le id de l'utilisateur que tu souhaite ajouter un cellier
     * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return boo de tous les bouteilles du cellier
	 */
    public function modifierCellier($idCellier, $idUtilisateur, $cellier__nom){
        $this->stmt = $this->_db->prepare("UPDATE vino__cellier SET cellier__nom = ?  WHERE id = ? AND fk__users_id = ?");
        $this->stmt->bind_param('sii',  $cellier__nom, $idCellier, $idUtilisateur);
        if($this->stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }


}