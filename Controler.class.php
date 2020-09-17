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
					$this->verificationUtilisateurConnecter();
					$this->listeBouteille();
					break;
				case 'autocompleteBouteille':
					$this->verificationUtilisateurConnecter();
					$this->autocompleteBouteille();
					break;
				case 'ajouterNouvelleBouteilleCellier':
					$this->verificationUtilisateurConnecter();
					$this->ajouterNouvelleBouteilleCellier();
					break;
				case 'ajouterBouteilleCellier':
					$this->verificationUtilisateurConnecter();
					$this->ajouterBouteilleCellier();
					break;
				case 'boireBouteilleCellier':
					$this->verificationUtilisateurConnecter();
					$this->boireBouteilleCellier();
					break;
				case 'modifierBouteilleCellier':
					$this->verificationUtilisateurConnecter();
					$this->modifierBouteilleCellier();
					break;
				case 'authentification':
					$this->authentification();
					break;
				case 'enregistrement':
					$this->enregistrement();
					break;
				case 'ajouterNouveauCellier':
					$this->verificationUtilisateurConnecter();
					$this->ajouterNouveauCellier();
					break;
					case 'cellier':
						$this->verificationUtilisateurConnecter();
						$this->cellier();
						break;
				default:
					$this->verificationUtilisateurConnecter();
					$this->cellier();
					break;
			}
		}

		//Fonction permetant de creer une session d"utilisateur
		private function createSessionUtilisateur($user){

			//Permet de demarrer une session et inserer des valeurs
			session_start();
			$_SESSION['users_id']  = $user['users_id'];
			$_SESSION['users_login']  = $user['users_login'];
			$_SESSION['users_type']  = $user['users_type'];

			//Execute une requete au modele pour avoir
			//le data de l'utilisateur
			$utilisateur = new Utilisateurs();
			$dataUtilisateur = $utilisateur->getCellierUtilisateur($user['users_id']);
			
			//Insere le id du cellier dans une varaible session
			$_SESSION['cellier_id'] = $dataUtilisateur[0]['id'];
			
			//Redirige vers l'accueil
			header('location:' . BASEURL . '?requete=cellier');
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
					}else{
						$data['motDePasseErreur'] = "Identifiant ou mot de passe incorect";
					}

				}

			} else {
				$data = [
					'identifiant' => "",
					'motDePasse' =>  "",
					'identifiantErreur' => "",
					'motDePasseErreur' => ""
				];
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
					if($utilisateur->enregistrementUtilisateur($data) == true){
						//Redirige vers le login
						header('location:' . BASEURL . '?requete=authentification');
					}
					
				}
			}

			//Load la vue pour register
			include("vues/register.php");

		}
		

		//Fonction permetant de verifier si un utilisateur est connecter
		private function verificationUtilisateurConnecter(){
			session_start();
			//verifie si un utlisateur est connecter
			if(empty($_SESSION['users_id'])){
				header('Location: '. BASEURL.'?requete=authentification');
			}
		}

		//Fonction permetant de verifier si un utilisateur est connecter
		private function deconnexionUtilisateur(){

			//Unset les donnees de la variable $_SESSION
			unset($_SESSION['users_id']);
			unset($_SESSION['users_login']);
			unset($_SESSION['users_type']);
			session_destroy();

			//Redirige vers l'authentification
			header('Location: '. BASEURL .'?requete=authentification');
		}


		private function cellier()
		{
			$bte = new Bouteille();
			if(isset($_GET['id'])){
				$data = $bte->getListeBouteilleCellier($_SESSION['users_id'], $_GET['id']);
			}else{
				$data = $bte->getListeBouteilleCellier($_SESSION['users_id']);
			}
			

			//Créer un objet utilisateur pour aller chercher les celliers qui possede
			$utilisateur = new Utilisateurs();
			$celliers = $utilisateur->getCellierUtilisateur($_SESSION['users_id']);

			//initialise une variable $i
			$i = 1;

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
				$resultat = $bte->ajouterBouteilleCellier($body, $_SESSION['cellier_id']);
				echo json_encode($resultat);
			}
			else{
				//Créer un objet utilisateur pour aller chercher les celliers qui possede
				$utilisateur = new Utilisateurs();
				$celliers = $utilisateur->getCellierUtilisateur($_SESSION['users_id']);

				//initialise une variable $i
				$i = 1;
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
				$resultat = $bte->modifierBouteilleCellier($body, $_SESSION['cellier_id']);
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

		//Fonction permetant d'ajouter un nouveau cellier a l'utilisateur
		private function ajouterNouveauCellier(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$cellier = new Cellier();
				if($cellier->ajouterCellier($_SESSION['users_id'])){
					//Redirige vers l'authentification
					header('Location: '. BASEURL .'?requete=cellier');
					echo "Bien ajouter";
				}
			}
			include("vues/entete.php");
			include("vues/ajouterCellier.php");
			include("vues/pied.php");
		}
		
}
?>















