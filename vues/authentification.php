<div class="authentification">
    <div class="authentification-contenu">
       
        <form class="form" action="<?php echo BASEURL?>?requete=authentification" method = "POST">
             <h1 class="titre">Connexion</h1>
             <?= ($lastUser !== "") ? "<p>Compte ajoutee</p>" : ""?>
             <hr>
            <input type="text" value ="<?=$lastUser ?>"placeholder="Identifiant *" name="identifiant">
            <span class="retourErreur">
                <?php echo $data['identifiantErreur']?>
            </span>
            <input type="password" placeholder="Mot de passe *" name="motDePasse">
            <span class="retourErreur">
                <?php echo $data['motDePasseErreur']?>
            </span>

            <button id="submit" type="submit" value="submit">Se connecter</button>

            <p class="options"><a href="<?php echo BASEURL?>?requete=accueil"><b>
            Retour à la page d'accueil</b></a></p>
        </form>
    </div>
</div>