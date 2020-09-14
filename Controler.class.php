<?php
/**
 * Class Controler
 * Gère les requêtes HTTP
 * 
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 * 
 */

class Controler 
{
	
		/**
		 * Traite la requête
		 * @return void
		 */
		public function gerer()
		{
			
			switch ($_GET['requete']) {
				case 'listeBouteille':
			
					$this->listeBouteille();
					break;
				case 'autocompleteBouteille':
				
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
				
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterBouteilleCellier':
		
					$this->ajouterBouteilleCellier();
					break;
				case 'boireBouteilleCellier':

					$this->boireBouteilleCellier();
					break;
				case 'modifierBouteilleCellier':
					$this->modifierBouteilleCellier();
					break;
				case 'authentification':
					$this->authentification();
					break;
				case 'enregistrement':
					$this->enregistrement();
					break;
				default:
					$this->accueil();
					break;
			}
		}

		//Fonction permetant de creer une session d"utilisateur
		private function createSessionUtilisateur($user){
			session_start();
			$_SESSION['users_id']  = $user['users_id'];
			$_SESSION['users_login']  = $user['users_login'];
			$_SESSION['users_type']  = $user['users_type'];
			//var_dump($_SESSION);
		}


		//Fonction permetant d'authentifier les utilisateurs
		private function authentification(){

			$data = [
				'identifiant' => "",
				'motDePasse' =>  "",
				'identifiantErreur' => "",
				'motDePasseErreur' => ""
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				//Sanitisation du post
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				
				$data = [
					'identifiant' => trim($_POST['identifiant']),
					'motDePasse' =>  trim($_POST['motDePasse']),
					'identifiantErreur' => "",
					'motDePasseErreur' => ""
				];
		
				//Validation du identifiant
				if(empty($data['identifiant'])){
					$data['identifiantErreur'] = 'Veuillez entrer un identifiant';
				}

				//Validation du mot de passe
				if(empty($data['motDePasse'])){
					$data['motDePasseErreur'] = 'Veuillez entrer un mot de passe';
				}

				//Verifie si il y a aucune erreur
				if(empty($data['identifiantErreur']) && empty($data['motDePasseErreur'])){
					
					//Execute la requete vers le modele
					$utilisateur = new Utilisateurs();
					$utilisateurConnecte = $utilisateur->controleUtilisateur($data);

					if($utilisateurConnecte) {
						$this->createSessionUtilisateur($utilisateurConnecte);
						//var_dump($_SESSION);
						$this->accueil();
						//$this->verificationUtilisateurConnecter();
					}else{
						$data['motDePasseErreur'] = "Identifiant ou mot de passe incorect";
	
					}

				}

			}

			//Load la vue pour authentification
			include("vues/authentification.php");

		}

		//Fonction permetant enregistrer des utilisateurs
		private function enregistrement(){

			$data = [
				'identifiant' => "",
				'motDePasse' => "",
				'confirmMotDePasse' => "",
				'identifiantErreur' => "",
				'motDePasseErreur' => "",
				'confirmMotDePasseErreur' => ""
			];

			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$data = [
					'identifiant' => trim($_POST['identifiant']),
					'motDePasse' => trim($_POST['motDePasse']),
					'confirmMotDePasse' => trim($_POST['confirmMotDePasse']),
					'identifiantErreur' => "",
					'motDePasseErreur' => "",
					'confirmMotDePasseErreur' => ""
				];

				//Validation du identifiant
				$expReg = "/^[a-zA-Z0-9]*$/";
				if(empty($data['identifiant'])){
					$data['identifiantErreur'] = 'Veuillez entrer un identifiant';
				}elseif(!preg_match($expReg, $data['identifiant'])){
					$data['identifiantErreur'] = 'Veuillez entrer que des lettres ou chiffres';
				}

				//Validation du mot de passe
				$expReg = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/i";
				if(empty($data['motDePasse'])){
					$data['motDePasseErreur'] = 'Veuillez entrer un mot de passe';
				}elseif(strlen($data['motDePasse']) < 7){
					$data['motDePasseErreur'] = 'Le mot de passe doit au moins 8 caracteres';
				}elseif(!preg_match($expReg, $data['motDePasse'])){
					$data['motDePasseErreur'] = 'Le mot de passe doit au moins contenir une lettre et un chiffre';
				}

				//Validation confirmation du mot de passe
				if(empty($data['confirmMotDePasse'])){
					$data['confirmMotDePasseErreur'] = 'Veuillez entrer un mot de passe';
				} elseif($data['motDePasse'] !== $data['confirmMotDePasse']){
					$data['confirmMotDePasseErreur'] = 'Veuillez entrer le meme mot de passe';
				}

				//Verifie si il y a des erreurs
				if(empty($data['identifiantErreur']) && empty($data['motDePasseErreur']) && empty($data['confirmMotDePasseErreur'])){
					$utilisateur = new Utilisateurs();
					//Insere l'utilisateur dans la DB

					if($utilisateur->enregistrementUtilisateur($data)){
						$utilisateur->enregistrementUtilisateur($data);
						//Redirige vers le login
						$this->authentification();
					}
					
				}
			}

			//Load la vue pour register
			include("vues/register.php");

		}
		

		//Fonction permetant de verifier si un utilisateur est connecter
		private function verificationUtilisateurConnecter(){
			
			//verifie si un utlisateur est connecter
			if(!isset($_SESSION['users_id'])){
				echo "Jesuis entrer";
				var_dump($_SESSION);
				header('Location: http://localhost/vino_etu/?requete=authentification');
			}
		}


		private function accueil()
		{
			$bte = new Bouteille();
            $data = $bte->getListeBouteilleCellier();
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
                  
		}
		

		private function listeBouteille()
		{
			$bte = new Bouteille();
			$cellier = $bte->getListeBouteilleCellier();
			//var_dump($cellier);
			
            echo json_encode($cellier);
                  
		}
		
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			//var_dump(file_get_contents('php://input'));
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}
		private function ajouterNouvelleBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			//var_dump($body);
			if(!empty($body)){
				$bte = new Bouteille();
				$resultat = $bte->ajouterBouteilleCellier($body);
				echo json_encode($resultat);
			}
			else{
				include("vues/entete.php");
				include("vues/ajouter.php");
				include("vues/pied.php");
			}
			
            
		}


		private function modifierBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			if(!empty($body)){
				$bte = new Bouteille();
				$resultat = $bte->modifierBouteilleCellier($body);
				echo json_encode($resultat);
			}
			else{
				$bte = new Bouteille();
            	$data = $bte->getUneBouteilleCellier($_GET['id']);
				include("vues/entete.php");
				include("vues/modifier.php");
				include("vues/pied.php");
			}
			
            
		}
		
		private function boireBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, -1);
			echo json_encode($resultat);
		}

		private function ajouterBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
			
			$bte = new Bouteille();
			$resultat = $bte->modifierQuantiteBouteilleCellier($body->id, 1);
			echo json_encode($resultat);
			
		}
		
}
?>















