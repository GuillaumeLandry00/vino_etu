<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Un petit verre de vino</title>
    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">

    <meta name="description" content="Un petit verre de vino">
    <meta name="author" content="Jonathan Martel (jmartel@cmaisonneuve.qc.ca)">

    <link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
    <base href="<?php echo BASEURL; ?>">
    <!-- ////////////google font/////////// -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic&family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    <script src="./js/main.js"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
</head>

<body>
    <header id="cellierBg">
        <div class="headerConnex">
            <?php if(isset($_SESSION['users_id'])):?>
            <span>Bonjour, <strong><?= $_SESSION['users_login']?></strong></span>
            <?php endif;?>
            <div class="deconnexion">
                <?php if(isset($_SESSION['users_id'])):?>
                <a href="?requete=authentification">Deconnexion</a>
                <?php endif;?>
                
            </div>
			
        </div>


        <div id="enteteCellier">
		
            <div class="menuLogo">
                <div class="logoHd">
                    <a href="?requete=cellier"><img id="logoCellier" src="./image/logo.png"></a>
                </div>
				
                <div class="menuHd">
					
                    <nav id="menuMobile">
					
						<input class="menu-btn" type="checkbox" id="menu-btn" />
  						<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
						
                        <ul id="menu_principal">
                            <li><a href="?requete=listeAchat">Ma liste d'achat:<?php echo(count($_SESSION['listeAchat'])); ?></a></li>
                            <li><a href="?requete=monCompte">Gerer mon compte</a></li>
                            <li><a href="?requete=cellier">Mon cellier</a></li>
                            <li><a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a></li>
                            <li><a href="?requete=ajouterNouveauCellier">Ajouter un cellier</a></li>
                        </ul>
						
                    </nav>


                </div>

            </div>

        </div>

        

        <h1>Un petit verre de vino ?</h1>
		

    </header>

    <main>
