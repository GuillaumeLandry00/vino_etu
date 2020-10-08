<?php
/**
 * Class Utilisateur
 * Cette classe possède les fonctions de gestion des utilisateurs.
 * @author Guillaume Landdry
 * @version 1.0
 * @update 2020-09-14
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Utilisateur extends Modele {
    const TABLE = 'users';

     /**
	 * Fonction: Permetant de voir la liste de tous les utilisateurs
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function getListeUtilisateur($mot_recherche ="", $critere ="users_login", $sens ="ASC")
	{
		
        $rows = Array();
        
        $requete ="Select * from ". self::TABLE . " WHERE users_login LIKE '%".$mot_recherche."%' ORDER BY " .$critere. " " .$sens;

		$res = $this->_db->query($requete);
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
	 * Fonction: Permetant de faire l'authentification des utilisateurs
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function controleUtilisateur($data){

        //Créer la requete
        // $this->stmt = $this->_db->prepare("SELECT * FROM users
        // WHERE users_login= ? AND users_mpd = SHA2(?, 256)");

        // //Bind les params
        // $this->stmt->bind_param('ss', $data['identifiant'], $data['motDePasse']);
        // $rowCount = $this->stmt->fetchColumn();

        $requete =  "SELECT * FROM users
         WHERE users_login= '". $data['identifiant']."' AND users_mpd = SHA2('".$data['motDePasse'] ."', 256)";
        $rowCount = $this->_db->query($requete)->num_rows;
        $result = $this->_db->query($requete)->fetch_array() ;
        if($rowCount > 0){
            return $result;
        } else {
            return false;
        }
    }

    /**
	 * Fonction: Permetant d'ajouter un utilisateur a la DB
     * 
     * @param $data array[] contenant les donnees de l"utilisateur
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function enregistrementUtilisateur($data){

        try {
            //Debut transaction
            $this->_db->begin_transaction() ;
            
            //Créer la 1er requete
            $this->stmt = $this->_db->prepare("INSERT INTO users (users_login, users_mpd, users_type)
            VALUES (?, SHA2(?,256), 'utilisateur')");
            //Bind les params
            $this->stmt->bind_param('ss', $data['identifiant'], $data['motDePasse']);
            $this->stmt->execute();


            //Créer la 2e requete
            $this->stmt = $this->_db->prepare("INSERT INTO  vino__cellier(fk__users_id, cellier__nom) VALUES (?,'Mon premier Cellier');");

            //Permet d'aller chercher le id de l'utilisateur
            $idUtilisateur = $this->controleUtilisateur($data);

            //Bind le param
            $this->stmt->bind_param('i', $idUtilisateur['users_id'] );
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
	 * Fonction: Permetant d'aller chercher les cellier de l'utilisateur
     * 
     * @param $idUtilisateur : Id de l'utilisateur rechercher
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function getCellierUtilisateur($idUtilisateur){

        //Initialise l'array rows
        $rows = Array();

        //Créer la requete
        $requete="SELECT id, cellier__nom FROM vino__cellier AS C
        INNER JOIN users AS U ON C.fk__users_id=U.users_id
        WHERE C.fk__users_id=" . $idUtilisateur;

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
	 * Fonction: Permetant de faire l'authentification des utilisateurs
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function supprimerUtilisateur($idUtilisateur){
        try {
            //Debut transaction 
            $this->_db->begin_transaction() ;
            
            //Créer la 1er requete(1er partie)
            $utilisateur = $this->getCellierUtilisateur($idUtilisateur);
           
            //Permet de delete tous les bouteilles assoccier au cellier appartenant a l'utilisateur
            foreach($utilisateur as $index => $valeur){
                //Permet d'aller chercher le id du cellier $valeur['id']; 
                $this->stmt = $this->_db->prepare("DELETE FROM cellier__bouteille WHERE  vino__cellier_id = ?");
                 //Bind le param
                
                $this->stmt->bind_param('i', $valeur['id'] );
                $this->stmt->execute();
                
            }
            

            //Créer la 2e requete(2e partie)
            $this->stmt = $this->_db->prepare("DELETE FROM vino__cellier WHERE  fk__users_id = ?");
            //Bind le param
            $this->stmt->bind_param('i', $idUtilisateur);
            $this->stmt->execute();

            //Créer la 3e requete(3e partie)
            $this->stmt = $this->_db->prepare("DELETE FROM users WHERE  users_id = ?");
            //Bind le param
            $this->stmt->bind_param('i', $idUtilisateur);
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
	 * Fonction: Permetant d'ajouter un utilisateur a la DB
     * 
     * @param $data array[] contenant les donnees de l"utilisateur
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function modificationUtilisateur($data, $idUtilisateur){
        
        $this->stmt = $this->_db->prepare("UPDATE users SET users_login = ?, users_mpd =  SHA2(?, 256)  WHERE users_id = ?");
        $this->stmt->bind_param('ssi',  $data['identifiant'],  $data['motDePasse'], $idUtilisateur);
        if($this->stmt->execute()){
            return true;
        }else{
             return false;
        }
            
    }

    /**
	 * Fonction: Permetant d'ajouter un utilisateur a la DB
     * 
     * @param $data array[] contenant les donnees de l"utilisateur
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est upgrade
	 */
    public function ajouterDroitAdmin($id, $droit){
        $this->stmt = $this->_db->prepare("UPDATE users SET users_type = ? WHERE users_id = ?");
        $this->stmt->bind_param('si', $droit, $id);
        if($this->stmt->execute()){
            return true;
        }else{

            return false;
        }
            
    }
    /**
	 * Fonction: Permetant d'ajouter un utilisateur a la DB
     * 
     * @param $data array[] contenant les donnees de l"utilisateur
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est upgrade
	 */
    public function getUnUtilisateur($id){
        //Initialise l'array rows
        $rows = Array();

        //Créer la requete
        $requete="SELECT * FROM users WHERE users_id=" . $id;

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
	 * Fonction: Permetant d'ajouter un utilisateur a la DB
     * 
     * @param $data array[] contenant les donnees de l"utilisateur
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est upgrade
	*/
    public function getStatisiqueUtilisateur($by = "nbCellier", $ordre = "DESC", $time = "*"){
        //Initialise l'array rows
        $rows = Array();

        //Créer la requete
        $requete="SELECT
        U.users_login,
        COUNT(DISTINCT(VC.id)) AS nbCellier,
        COUNT(DISTINCT(CB.vino__bouteille_id)) AS nbBouteille,
        IFNULL(SUM(CB.quantite),0) AS qtTotal,
        IFNULL(SUM(CB.prix),0) AS sumPrix
        FROM
            users AS U
        LEFT JOIN vino__cellier AS VC
        ON
            U.users_id = VC.fk__users_id
        LEFT JOIN cellier__bouteille AS CB
        ON
            VC.id = CB.vino__cellier_id";

        //Permet de verifier si nous souhaitons ajouter une date
        if($time !== "*"){
            $requete .= " WHERE U.date_inscription > '$time'";
        }
        
        $requete .= " GROUP BY
            U.users_login
        ORDER BY    
        ". $by . " " . $ordre;

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

}