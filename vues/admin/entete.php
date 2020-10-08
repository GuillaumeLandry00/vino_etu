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
		<!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
		<script src="./js/main.js"></script>
	</head>
	<body >
		<header>
			<h1>Vue admin</h1>
			<nav>
			</nav>
            <?php 
            if(isset($_SESSION['users_id'])):?>
				<span>Bonjour, <strong><?= $_SESSION['users_login']?></strong></span>
			<?php endif;?>
			<div class="deconnexion">
			<?php if(isset($_SESSION['users_id'])):?>
				<a href="?requete=authentification">Deconnexion</a>
			<?php endif;?>
			</div>
		</header>
		<main>
			