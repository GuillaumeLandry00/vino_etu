<?php
  /**
   * Faire l'assignation des variables ici avec les isset() ou !empty()
   */
   
   
	if(empty($_GET['requete']))
	{
		$_GET['requete'] = '';
	}
    
	if(isset($_POST['identifiant'])){
		$donneUtilisateur = $_POST['identifiant'];
	}
	
   
   
?>