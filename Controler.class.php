<?php
error_reporting(0);
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
					case 'rechercher':
						$this->BouteilleRechercher();
						break;
				default:
					$this->verificationUtilisateurConnecter();
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
			header('location:' . BASEURL . '?requete=accueil');
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
					if($utilisateur->enregistrementUtilisateur($data)){
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
				header('Location: http://localhost/vino_etu/?requete=authentification');
			}
		}


		private function accueil()
		{	
			 $bte = new Bouteille();
             $data= $bte->getListeBouteilleCellier();
			include("vues/entete.php");
			include("vues/cellier.php");
			include("vues/pied.php");
				
		}
		

		private function listeBouteille()
		{
			$bte = new Bouteille();
			$cellier = $bte->getListeBouteilleCellier();
            echo json_encode($cellier);
                  
		}
		
		private function autocompleteBouteille()
		{
			$bte = new Bouteille();
			$body = json_decode(file_get_contents('php://input'));
            $listeBouteille = $bte->autocomplete($body->nom);
            
            echo json_encode($listeBouteille);
                  
		}
		private function ajouterNouvelleBouteilleCellier()
		{
			$body = json_decode(file_get_contents('php://input'));
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
        /**
		 * fonction de modification des  bouteilles dans le cellier
		 * 
		 */

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
		/**
		 * fonction de boire une bouteiile
		 * STRATEGIE:retire un bouiteille dans le cellier
		 */
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
		/* fonction de recherhce des bouitellles dans le cellier du cellier 
		*/
	private function BouteilleRechercher(){
		
		$bte = new Bouteille();
		$recherche = isset($_POST['tri']) ? trim($_POST['recherche_bouteille']) : "";
		 $critere    = isset($_POST['tri']) ? trim($_POST['typeTri']) : "vino__bouteille_id";
		 $sens       = isset($_POST['tri']) ? trim($_POST['ordre']) : "ASC";
		  $data= $bte->getListeBouteilleCellier($critere,$sens,$recherche);
			 include("vues/entete.php");
			 include("vues/cellier.php");
			 include("vues/pied.php");
		 }
		
}
?>















