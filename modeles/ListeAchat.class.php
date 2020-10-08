<?php
/**
 * Class Utilisateur
 * Cette classe possède les fonctions de gestion de la liste d achat.
 * @author Guillaume Landdry
 * @version 1.0
 * @update 2020-09-14
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */
class ListeAchat extends Modele {
   
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
	/* fonction d ajout des sessions */
  public function addSession($id,$data,$q,$utilisateur){
	  $_SESSION['listeAchat'][$id][$utilisateur]=$data;
	  $_SESSION['quantite'][$id]=$q;
	  if(count($_SESSION['listeAchat'][$id][$utilisateur]>0)){
       $res=true;
	  }else{
		$res=false;
	  }
   return $res;
  }
  const TABLE = 'vino__bouteille';
    
	public function getListeAchatBouteille($tab=array())
	{
		
		$rows = Array();
		$res = $this->_db->query('Select * from '. self::TABLE.'where id IN ('.implode(',',$tab).')');
		if($res->num_rows)
		{
			while($row = $res->fetch_assoc())
			{
				$rows[] = $row;
			}
		}
		
		return $rows;
	}
}