<?php
/**
 * Class Bouteille
 * Cette classe possède les fonctions de gestion des bouteilles dans le cellier et des bouteilles dans le catalogue complet.
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class Bouteille extends Modele {
	const TABLE = 'vino__bouteille';
    
	public function getListeBouteille()
	{
		
		$rows = Array();
		$res = $this->_db->query('Select * from '. self::TABLE);
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
	 * Fonction: Permetant de montrer tous les bouteilles qui sont dans des celliers
	 * 
	 * TODO:: Ajouter un WHERE losrqu'on nous allons avoir les USER et ajouter param
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array de tous les bouteilles du cellier
	 */
	public function getListeBouteilleCellier()
	{
		
		$rows = Array();
		$requete ='SELECT
		B.nom,
		B.format,
		B.image,
		B.code_saq,
		B.pays,
		B.description,
		B.prix_saq,
		B.url_saq,
		B.url_img,
		C.quantite,
		C.prix,
		C.date_achat,
		C.notes,
		C.garde_jusqua,
		C.millesime,
		T.type,
		C.vino__bouteille_id
		FROM cellier__bouteille AS C
		INNER JOIN vino__bouteille AS B ON C.vino__bouteille_id = B.id
		INNER JOIN vino__type AS T ON B.fk__vino__type_id =T.id
		'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
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
	 * Fonction: Permetant de montrer tous les bouteilles qui sont dans des celliers
	 * 
	 * TODO:: Ajouter un WHERE losrqu'on nous allons avoir les USER et ajouter param
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array de tous les bouteilles du cellier
	 */
	public function getUneBouteilleCellier($id)
	{
		
		$rows = Array();
		$requete ='SELECT
		B.nom,
		B.format,
		B.image,
		B.code_saq,
		B.pays,
		B.description,
		B.prix_saq,
		B.url_saq,
		B.url_img,
		C.quantite,
		C.prix,
		C.date_achat,
		C.notes,
		C.garde_jusqua,
		C.millesime,
		T.type,
		C.vino__bouteille_id
		FROM cellier__bouteille AS C
		INNER JOIN vino__bouteille AS B ON C.vino__bouteille_id = B.id
		INNER JOIN vino__type AS T ON B.fk__vino__type_id =T.id
		WHERE C.vino__bouteille_id = '.$id.'
		'; 
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
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
	 * Cette méthode permet de retourner les résultats de recherche pour la fonction d'autocomplete de l'ajout des bouteilles dans le cellier
	 * 
	 * @param string $nom La chaine de caractère à rechercher
	 * @param integer $nb_resultat Le nombre de résultat maximal à retourner.
	 * 
	 * @throws Exception Erreur de requête sur la base de données 
	 * 
	 * @return array id et nom de la bouteille trouvée dans le catalogue
	 */
       
	public function autocomplete($nom, $nb_resultat=10)
	{
		
		$rows = Array();
		$nom = $this->_db->real_escape_string($nom);
		$nom = preg_replace("/\*/","%" , $nom);
		 
		//echo $nom;
		$requete ='SELECT id, nom FROM vino__bouteille where LOWER(nom) like LOWER("%'. $nom .'%") LIMIT 0,'. $nb_resultat; 
		//var_dump($requete);
		if(($res = $this->_db->query($requete)) ==	 true)
		{
			if($res->num_rows)
			{
				while($row = $res->fetch_assoc())
				{
					$row['nom'] = trim(utf8_encode($row['nom']));
					$rows[] = $row;
					
				}
			}
		}
		else 
		{
			throw new Exception("Erreur de requête sur la base de données", 1);
			 
		}
		
		
		//var_dump($rows);
		return $rows;
	}
	
	
	/**
	 * Cette méthode ajoute une ou des bouteilles au cellier
	 * 
	 * @param Array $data Tableau des données représentants la bouteille.
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function ajouterBouteilleCellier($data)
	{

		//Initialise un tableau pour inserer des erreurs
		$erreur = array();

		//Verification bon format de date YYYY-MM-DD seulement si une valeur est entr/
		if($data->date_achat !== ""){
			$regExp = "/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/i";
			if(!preg_match($regExp, $data->date_achat)){
				//Ajoute une erreur dans le tableau
				$erreur["date_achat"] = true;
			}
		}
		if($data->garde_jusqua !== ""){
			$regExp = "/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/i";
			if(!preg_match($regExp, $data->garde_jusqua)){
				//Ajoute une erreur dans le tableau
				$erreur["garde_jusqua"] = true;
			}
		}

		//Verification du prix 
		$regExp = "/^[1-9]\d*\.?\d\d$/i";
		if(!preg_match($regExp, $data->prix)){
			$erreur["prix"] = true;
		}

		//Verification de la quantite
		$regExp = "/^[1-9]\d*$/i";
		if(!preg_match($regExp, $data->quantite)){
			$erreur["quantite"] = true;
		}

		//Verification  du millesime 1000 à 2999
		if($data->millesime !== ""){
			
			$regExp = "/^[12][0-9]{3}$/i";
			if(!preg_match($regExp, $data->millesime)){
				$erreur["millesime"] = true ;
			}
		}

		//Verifie si il y a des erreurs
		if(count($erreur) == 0){
			$requete = "INSERT INTO cellier__bouteille(vino__bouteille_id,vino__cellier_id,date_achat,garde_jusqua,notes,prix,quantite,millesime)
			VALUES (".
			"'".$data->id_bouteille."',".
			//Todo aller chercher le cellier de l'user je l'ai mi a 1 pour des fins pratique
			"'". 1 ."',".
			"'".$data->date_achat."',".
			"'".$data->garde_jusqua."',".
			"'".$data->notes."',".
			"'".$data->prix."',".
			"'".$data->quantite."',".
			"'".$data->millesime."')";

			$res = $this->_db->query($requete);

		}else{
			//Si contient erreur envoie quelle sont les erreurs
			$res = $erreur;
			
		}
		return $res;
	}

	/**
	 * Cette méthode change les données d'une bouteille dans le cellier
	 * 
	 * @param array $data contenant tous les infos necessaire
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierBouteilleCellier($data)
	{
		
		//Initialise un tableau pour inserer des erreurs
		$erreur = array();

		//Verification bon format de date YYYY-MM-DD seulement si une valeur est entr/
		if($data->date_achat !== ""){
			$regExp = "/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/i";
			if(!preg_match($regExp, $data->date_achat)){
				//Ajoute une erreur dans le tableau
				$erreur["date_achat"] = true;
			}
		}
		if($data->garde_jusqua !== ""){
			$regExp = "/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/i";
			if(!preg_match($regExp, $data->garde_jusqua)){
				//Ajoute une erreur dans le tableau
				$erreur["garde_jusqua"] = true;
			}
		}

		//Verification du prix 
		$regExp = "/^[1-9]\d*\.?\d\d$/i";
		if(!preg_match($regExp, $data->prix)){
			$erreur["prix"] = true;
		}

		//Verification de la quantite
		$regExp = "/^[1-9]\d*$/i";
		if(!preg_match($regExp, $data->quantite)){
			$erreur["quantite"] = true;
		}

		//Verification  du millesime 1000 à 2999
		if($data->millesime !== ""){
			
			$regExp = "/^[12][0-9]{3}$/i";
			if(!preg_match($regExp, $data->millesime)){
				$erreur["millesime"] = true ;
			}
		}

		//Verifie si il y a des erreurs
		if(count($erreur) == 0){
			$requete = "UPDATE cellier__bouteille
			SET quantite = " . $data->quantite . ", 
			prix = " . $data->prix . ", 
			date_achat = ' " . $data->date_achat . " ', 
			notes = ' " . $data->notes . " ', 
			garde_jusqua = ' " . $data->garde_jusqua . " ', 
			millesime = " . $data->millesime . "
			WHERE vino__bouteille_id = " . $data->id . " AND vino__cellier_id=1;"; 
			//TODO: Aller chercher le $id du cellier avec $_SESSION
			$res = $this->_db->query($requete);
		}else{
			//Si contient erreur envoie quelle sont les erreurs
			$res = $erreur;

		}
        
		return $res;
	}
	
	
	/**
	 * Cette méthode change la quantité d'une bouteille en particulier dans le cellier
	 * 
	 * @param int $id id de la bouteille
	 * @param int $nombre Nombre de bouteille a ajouter ou retirer
	 * 
	 * @return Boolean Succès ou échec de l'ajout.
	 */
	public function modifierQuantiteBouteilleCellier($id, $nombre)
	{
		//TODO : Valider les données.
			
			
		$requete = "UPDATE cellier__bouteille SET quantite = GREATEST(quantite + ". $nombre. ", 0) WHERE 	vino__bouteille_id = ". $id;
		//echo $requete;
        $res = $this->_db->query($requete);
        
		return $res;
	}
}




?>