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
class Utilisateurs extends Modele {
    const TABLE = 'users';

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
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return 1 si l'utilisateur est trouve
	 */
    public function enregistrementUtilisateur($data){

        //Créer la requete
        $this->stmt = $this->_db->prepare("INSERT INTO users (users_login, users_mpd, users_type)
        VALUES (?, SHA2(?,256), 'utilisateur')
        ");

        //Bind les params
        $this->stmt->bind_param('ss', $data['identifiant'], $data['motDePasse']);

        //Execute la requete à la DB
        if($this->stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}