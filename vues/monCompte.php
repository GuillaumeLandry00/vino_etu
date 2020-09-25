<div class="monCompte">
    <div class="container-monCompte">
        <h2>Gestion de mon compte</h2>
        <form action="" method="post">
            <div class="modification-compte">
                <h3>Modifier mon compte</h3>
                <label for="nom">Veuillez entrer votre nom: </label>
                <input type="text" name="nom" value="<?= $_SESSION['users_login']?>" placeholder="Veuillez entrer un nom">
                <br>
                <label for="motDePasse">Veuillez entrer votre mot de passe: </label>
                <input type="password" name="motDePasse" placeholder="Veuillez entrer un mot de passe">
                <span class="retourErreur">
                <?php echo $data['motDePasseErreur']?>
                </span>
                <br>
                <label for="motDePasseConf">Veuillez confirmer votre mot de passe: </label>
                <input type="password" name="motDePasseConf" placeholder="Veuillez confirmer votre mot de passe">
                <span class="retourErreur">
                <?php echo $data['confirmMotDePasseErreur']?>
                </span>
                <br>
                <label for="ancienMotDePasse">Veuillez entrer votre ancien mot de passe: </label>
                <input type="password" name="ancienMotDePasse" placeholder="Veuillez entrer votre ancien mot de passe">
                <span class="retourErreur">
                <?php echo $array['ancienMotDePasseErreur']?>
                 </span>
                <button id="submit" type="submit" value="submit" name="modifierUtilisateur">Modifier</button>
                <span class="confirmation">
                <?= $data['confirmation'] ?>
                </span>
            </div>
            <div class="suppression-compte">
                <h3>Supprimer mon compte</h3>
                <strong>Êtes-vous vraiment sur de vouloir supprimer votre compte
                 vous allez perdre tous vos bouteilles enregistrées et vos cellier</strong>
                 <br>
                <label for="ancienMotDePasse">Veuillez entrer votre ancien mot de passe: </label>
                <input type="password" name="ancienMotDePasseSupp" placeholder="Veuillez entrer votre ancien mot de passe">
                <span class="retourErreur">
                <?php echo $array['ancienMotDePasseErreurSupp']?>
                <button id="submit" type="submit" value="submit" name="supprimerUtilisateur">Oui</button>
                <button><a href="?requete=cellier">Non</a></button>
            </div>
        </form>
        
    </div>
</div>