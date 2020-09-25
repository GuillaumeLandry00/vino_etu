<div class="enregistrement">
    <div class="enregistrement-contenu" vertical layout>
        
        <form action="" method = "POST">
            <h1 class="titre">M'INSCRIRE</h1>
             <hr>
            <input type="text" placeholder="Identifiant *" name="identifiant">
            <span class="retourErreur">
                <?php echo $data['identifiantErreur']?>
            </span>
            <br>
            <input type="password" placeholder="Mot de passe *" name="motDePasse">
            <span class="retourErreur">
                <?php echo $data['motDePasseErreur']?>
            </span>
            <br>
            <input type="password" placeholder="Confirmer votre Mot de passe *" name="confirmMotDePasse">
            <span class="retourErreur">
                <?php echo $data['confirmMotDePasseErreur']?>
            </span>
            <br>
            <button id="submit" type="submit" value="submit">Créer mon compte</button>

            <p class="options">J'ai déjà un compte ! <a href="<?php echo BASEURL?>?requete=authentification">Se connecter</a></p>
        </form>
    </div>
</div>