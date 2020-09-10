<?php
//initialisation de la session
	
error_reporting(-1);
ini_set("display_errors", 1);
$s = curl_init();
$article_url = 'https://www.saq.com/fr/produits/vin/vin-rouge?p=1&product_list_limit=24&product_list_order=name_asc';
if (isset($article_url)){
  $title = 'contact us';
  $str = @file_get_contents($article_url);
  // return an error
  if ($str === FALSE) {
    echo 'problem getting url';
    return false;
  }

  // Continue
  //compte les mots
  $test1 = str_word_count(strip_tags(strtolower($str)));
  //var_dump($test1 );
  if ($test1 === FALSE) $test = '0';

  if ($test1 > '550') {
    echo '<div><i class="fa fa-check-square-o" style="color:green"></i> This article has ' . $test1 . ' words.';
  } else {
    echo '<div><i class="fa fa-times-circle-o" style="color:red"></i> This article has ' . $test1 . ' words. You are required to have a minimum of 500 words.</div>';
  }
        curl_setopt($s, CURLOPT_URL, $article_url);
		curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($s, CURLOPT_FOLLOWLOCATION, 1);

		$html = curl_exec($s);
curl_close($s);
  $document = new DOMDocument();
 //$libxml_previous_state = libxml_use_internal_errors(true);
 // var_dump( $libxml_previous_state );
 // $document->loadHTML($str);
 var_dump( @ $document->loadHTML($str) );
 // libxml_use_internal_errors($libxml_previous_state);

  $elementList = $document->getElementsByTagName('LI');
  var_dump(count($elementList));
  $tags = array ( 'li');
  $texts = array ();

  foreach($tags as $tag) {
    $elementList = $document->getElementsByTagName($tag);
   // var_dump(count($elementList));
    foreach($elementList as $key =>$noeud) {
     // var_dump($noeud);
      // $texts[$element->tagName] = strtolower($element->textContent);
     // var_dump($element->textContent);
     if (strpos($noeud -> getAttribute('class'), "product-item") !== false) {

       // echo get_inner_html($noeud);
        $info = recupereInfo($noeud);
      //  var_dump($info);
      //recuperer les infos 
        echo "<p>".$info->nom;
        echo "<p>".$info->img;
        echo "<p>".$info->url;
        echo "<p>".$info -> desc -> type;
        echo "<p>".$info -> desc -> format;
        echo "<p>".$info -> desc -> code_SAQ;
        echo "<p>".$info -> desc -> pays;
        echo "<p>".$info->prix;
    
         $retour =  ajouteProduit($info);
        echo "<br>Code de retour : " . $retour -> raison . "<br>";
        // if ($retour -> succes == false) {
        //     echo "<pre>";
        //     var_dump($info);
        //     echo "</pre>";
        //     echo "<br>";
        // } else {
        //     $i++;
        // }
        echo "</p>";
    }
    }
   
  }
  

  if (in_array(strtolower($title),$texts)) {
    echo '<div><i class="fa fa-check-square-o" style="color:green"></i> This article used the correct title tag.</div>';
  } else {
    echo "no";
  }

}
/**
 * function qui retourne tout les boueilles de l url
 * @param $node l'element li 
 * @return la page hmtl des bouteilles
 */
 function get_inner_html($node) {
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
 function nettoyerEspace($chaine)
	{
		return preg_replace('/\s+/', ' ',$chaine);
    }

    /**
     * recuperer les donnees de chaque element li 
     */
 function recupereInfo($noeud) {
		
		$info = new stdClass();
        $info -> img = $noeud -> getElementsByTagName("img") -> item(0) -> getAttribute('src'); 
        //TODO : Nettoyer le lien
		
		$a_titre = $noeud -> getElementsByTagName("a") -> item(0);
		$info -> url = $a_titre->getAttribute('href');
		
        $info -> nom = nettoyerEspace(trim($a_titre -> textContent));
        	//TODO : Retirer le format de la bouteille du titre.
		
		// Type, format et pays
		$aElements = $noeud -> getElementsByTagName("strong");
		foreach ($aElements as $node) {
			if ($node -> getAttribute('class') == 'product product-item-identity-format') {
				$info -> desc = new stdClass();
				$info -> desc -> texte = $node -> textContent;
				$info->desc->texte = nettoyerEspace($info->desc->texte);
				$aDesc = explode("|", $info->desc->texte); // Type, Format, Pays
				if (count ($aDesc) == 3) {
					
					$info -> desc -> type = trim($aDesc[0]);
					$info -> desc -> format = trim($aDesc[1]);
					$info -> desc -> pays = trim($aDesc[2]);
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
				$info -> prix = trim($node -> textContent);
			}
		}
		//var_dump($info);
		return $info;
    }
    /**
     * ajout du produit 
     */
     function ajouteProduit($bte) {
		$retour = new stdClass();
		$retour -> succes = false;
		$retour -> raison = '';

		var_dump($bte);
		// Récupère le type
		//$rows = $this -> _db -> query("select id from vino__type where type = '" . $bte -> desc -> type . "'");
		
		// if ($rows -> num_rows == 1) {
		// 	$type = $rows -> fetch_assoc();
		// 	//var_dump($type);
		// 	$type = $type['id'];

		// 	$rows = $this -> _db -> query("select id from vino__bouteille where code_saq = '" . $bte -> desc -> code_SAQ . "'");
		// 	if ($rows -> num_rows < 1) {
		// 		$this -> stmt -> bind_param("sissssisss", $bte -> nom, $type, $bte -> img, $bte -> desc -> code_SAQ, $bte -> desc -> pays, $bte -> desc -> texte, $bte -> prix, $bte -> url, $bte -> img, $bte -> desc -> format);
		// 		$retour -> succes = $this -> stmt -> execute();
		// 		$retour -> raison = INSERE;
		// 		//var_dump($this->stmt);
		// 	} else {
		// 		$retour -> succes = false;
		// 		$retour -> raison = DUPLICATION;
		// 	}
		// } else {
		// 	$retour -> succes = false;
		// 	$retour -> raison = ERREURDB;

		// }
		return $retour;

	}


?>