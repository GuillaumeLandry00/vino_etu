<?php
/**
 * Class Messagerie
 * Cette classe possède les fonctions de gestion de la messagerie.
 * @author Guillaume Landry
 * @version 1.0
 * @update 2020-09-14
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Messagerie extends Modele {
    const TABLE = 'messagerie';

    /**
    * Fonction: Permetant de voir la liste de tous les messages destine a l"admin
    * 
    * @throws Exception Erreur de requête sur la base de données 
    * 
    * @return $rows si il y a des messages
    */
   public function getListeMessage()
   {
       
       $rows = Array();
       $res = $this->_db->query('Select * from messagerie AS M
       INNER JOIN users AS U ON M.fk_users_id=U.users_id');
       if($res->num_rows)
       {
           while($row = $res->fetch_assoc())
           {
               $rows[] = $row;
           }
       }
       
       return $rows;
   }


    /**
    * Fonction: Permetant de supprimer un message de la messagerie
    * 
    * @throws Exception Erreur de requête sur la base de données 
    * 
    * @return Boolean 
    */
   public function supprimerUnMessage($id){
		
        $this->stmt = $this->_db->prepare("DELETE FROM messagerie WHERE id = ?");
        //Bind les params
        $this->stmt->bind_param('i', $id);
        return $this->stmt->execute();	
    }

    /**
    * Fonction: Permetant de supprimer un message de la messagerie
    * 
    * @throws Exception Erreur de requête sur la base de données 
    * 
    * @return Boolean 
    */
   public function ajouterMessage($texte, $idUtilisateur){
		
    $this->stmt = $this->_db->prepare("INSERT INTO messagerie (message, fk_users_id) VALUES(?,?)");
    //Bind les params
    $this->stmt->bind_param('si', $texte, $idUtilisateur);
    return $this->stmt->execute();	
}

}