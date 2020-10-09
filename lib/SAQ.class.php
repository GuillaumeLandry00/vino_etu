<?php
/**
 * Class MonSQL
 * Classe qui génère ma connection à MySQL à travers un singleton
 *
 *
 * @author Jonathan Martel
 * @version 1.0
 *
 *
 *
 */
class SAQ extends Modele {

	const DUPLICATION = 'duplication';
	const ERREURDB = 'erreurdb';
	const INSERE = 'Nouvelle bouteille insérée';

	private static $_webpage;
	private static $_status;
	private $stmt;

	public function __construct() {
		parent::__construct();
		if (!($this -> stmt = $this -> _db -> prepare("INSERT INTO vino__bouteille(nom, image, code_saq, pays, description, prix_saq, url_saq, url_img,format,fk__vino__type_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"))) {
			echo "Echec de la préparation : (" . $mysqli -> errno . ") " . $mysqli -> error;
		}
	}

	/**
	 * getProduits
	 * @param int $nombre
	 * @param int $debut
	 */
	public function getProduits($nombre = 24, $page = 1, $type = "blanc") {
	//gestion des alertes
		error_reporting(-1);
		ini_set("display_errors", 1);
		$s = curl_init();
		$article_url = 'https://www.saq.com/fr/produits/vin/vin-'.$type.'?p='.$page.'&product_list_limit='.$nombre.'&product_list_order=name_asc';
		//verifier que l url existe 
		if (isset($article_url)){
		  $str = @file_get_contents($article_url);
		  // retourne  des erreurs
		  if ($str === FALSE) {
			echo 'problem getting url';
			return false;
		  }
		//$url = "https://www.saq.com/fr/produits/vin/vin-rouge?p=1&product_list_limit=24&product_list_order=name_asc";
		//curl_setopt($s, CURLOPT_URL, "http://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?searchType=&orderBy=&categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=".$debut."&tri=&metaData=YWRpX2YxOjA8TVRAU1A%2BYWRpX2Y5OjE%3D&pageSize=". $nombre ."&catalogId=50000&searchTerm=*&sensTri=&pageView=&facet=&categoryId=39919&storeId=20002");
		//curl_setopt($s, CURLOPT_URL, "https://www.saq.com/webapp/wcs/stores/servlet/SearchDisplay?categoryIdentifier=06&showOnly=product&langId=-2&beginIndex=" . $debut . "&pageSize=" . $nombre . "&catalogId=50000&searchTerm=*&categoryId=39919&storeId=20002");
		curl_setopt($s, CURLOPT_URL, $article_url);
		curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);

		$i = 0;
		
				curl_setopt($s, CURLOPT_URL, $article_url);
				curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
				//curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);
		
				self::$_webpage = curl_exec($s);
		  curl_close($s);
		  $document = new DOMDocument();
		  //chargement de la page
		  @ $document->loadHTML($str);
		//recuperer tous les Li
		  $elementList = $document->getElementsByTagName('LI');
		  $i = 0;
		  $tags = array ( 'li');
		  $texts = array ();
		
		  foreach($tags as $tag) {
			$elementList = $document->getElementsByTagName($tag);
		   // var_dump(count($elementList));
			foreach($elementList as $key =>$noeud) {
			 if (strpos($noeud -> getAttribute('class'), "product-item") !== false) {
				
				
				$info = self::recupereInfo($noeud);
		

				
				 //netoyer le lien
				 
			     $pattern = '/https:/i';
				 $info -> img=preg_replace($pattern, '',$info->img);
				 

			    //affichage  des infos par necessaire 
				$data[$i]['nom'] = utf8_encode($info->nom);
				$data[$i]['img'] = $info->img;
				$data[$i]['url'] =$info->url;
				$data[$i]['type'] =$info ->desc->type;
				$data[$i]['format'] =$info ->desc->format;
				$data[$i]['code_SAQ'] =$info->desc ->code_SAQ;
				$data[$i]['pays'] =utf8_encode($info->desc->pays);
				$data[$i]['texte'] =$info->desc->texte;
				$data[$i]['prix'] =$info->prix;
			
				 $retour = self::ajouteProduit($info);
				$data[$i]['raison'] = $retour->raison;
				$i++;
			}
			}
		   
		  }
		  
		}
		
		return $data;
	}

	/**
 * function qui retourne tout les boueilles de l url
 * @param $node l'element li 
 * @return la page hmtl des bouteilles
 */
private function get_inner_html($node) {
    $innerHTML = '';
    $children = $node -> childNodes;
    foreach ($children as $child) {
        $innerHTML .= $child -> ownerDocument -> saveXML($child);
    }

    return $innerHTML;
}
/**
 * nettoie les espaces 
 */
private function nettoyerEspace($chaine)
	{
		return preg_replace('/\s+/', ' ',$chaine);
    }

    /**
     * recuperer les donnees de chaque element li 
     */
	private function recupereInfo($noeud) {
		
		$info = new stdClass();
		//traiter les images
		//var_dump( $noeud -> getElementsByTagName("img") -> item(0) ->getAttribute('class'));
		if ($noeud -> getElementsByTagName("img") -> item(0) ->getAttribute('class') == 'product-image-photo') {
			$info -> img = $noeud -> getElementsByTagName("img") -> item(0) -> getAttribute('src'); 
		}
		if ($noeud -> getElementsByTagName("img") -> item(0) ->getAttribute('class') == '') {
			$info -> img = $noeud -> getElementsByTagName("img") -> item(1) -> getAttribute('src'); 
		}
		
		
		
		$a_titre = $noeud -> getElementsByTagName("a") -> item(0);
		$info -> url = $a_titre->getAttribute('href');
		
        $info -> nom = self::nettoyerEspace(trim(utf8_encode ($a_titre -> textContent)));
		// Retirer le format de la bouteille du titre.
		//mettre le nom sous forme de tableau	
		$tabNom= explode(" ", $info -> nom);
		for($j=0; $j<count($tabNom)-3 ;$j++) {
		 $tab[]=$tabNom[$j]; 
		}
		//chainage des nom 
		$info -> nom=implode(" ", $tab);
		// Type, format et pays
		$aElements = $noeud -> getElementsByTagName("strong");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'product product-item-identity-format') {
				$info -> desc = new stdClass();
				$info -> desc -> texte = $node -> textContent;
				$info->desc->texte = self::nettoyerEspace($info->desc->texte);
				$aDesc = explode("|", $info->desc->texte); // Type, Format, Pays
				if (count ($aDesc) == 3) {
					
					$info -> desc -> type = trim($aDesc[0]);
					$info -> desc -> format = trim($aDesc[1]);
					$info -> desc -> pays = trim(utf8_encode ($aDesc[2]));
				}
				
				$info -> desc -> texte = trim($info -> desc -> texte);
			}
		}

		//Code SAQ
		$aElements = $noeud -> getElementsByTagName("div");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'saq-code') {
				if(preg_match("/\d+/", $node -> textContent, $aRes))
				{
					$info -> desc -> code_SAQ = trim($aRes[0]);
				}	
				
			}
		}

		$aElements = $noeud -> getElementsByTagName("span");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'price') {
				//Permet de convertir le prix en float
				$info -> prix = trim($node -> textContent);
				$info -> prix = preg_replace('/,/i', '.',$info->prix);
				$info -> prix = preg_replace('/\$/i', '',$info->prix);
				$info -> prix = floatval($info->prix);
			}
		}
		//var_dump($info);
		return $info;
    }
    /**
     * ajout du produit 
     */
    private function ajouteProduit($bte) {
		$retour = new stdClass();
		$retour -> succes = false;
		$retour -> raison = '';

	//	var_dump($bte);
		// Récupère le type
		$rows = $this -> _db -> query("select id from vino__type where type = '" . $bte -> desc -> type . "'");
		
		if ($rows -> num_rows == 1) {
			$type = $rows -> fetch_assoc();
			//var_dump($type);
			$type = $type['id'];
			
			$rows = $this -> _db -> query("select id from vino__bouteille where code_saq = '" . $bte -> desc -> code_SAQ . "'");
			if ($rows -> num_rows < 1) {
				$this -> stmt -> bind_param("sssssdsssi", $bte -> nom,  $bte -> img, $bte -> desc -> code_SAQ, $bte -> desc -> pays, $bte -> desc -> type, $bte -> prix, $bte -> url, $bte -> img, $bte -> desc -> format,$type);
				$retour -> succes = $this -> stmt -> execute();
				$retour -> raison = self::INSERE;
				//var_dump($this->stmt);
			} else {
				$retour -> succes = false;
				$retour -> raison = self::DUPLICATION;
			}
		} else {
			$retour -> succes = false;
			$retour -> raison = self::ERREURDB;

		}
		return $retour;

	}

	
}
?>