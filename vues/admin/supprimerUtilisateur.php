
<div class="container-adminCompte">
    <h2>Gestion du compte</h2>
    <form action="" method="post">
        <div class="suppression-compte">
             <h3>Supprimer compte</h3>
             <div class="description">
             <p><?= $data[0]['users_login']?></p>
             <p><?= $data[0]['users_type']?></p>
             </div>
            <strong>Êtes-vous vraiment sur de vouloir supprimer le compte
             '<?=$data[0]['users_login']?>' va perdre tous ses bouteilles enregistrées et ses cellier</strong>
                <br>
            <label for="ancienMotDePasse">Veuillez entrer votre mot de passe pour confirmer: </label>
            <input type="password" name="ancienMotDePasseSupp" placeholder="Veuillez entrer votre mot de passe">
            <span class="retourErreur">
            <?php echo $array['ancienMotDePasseErreurSupp']?>
            <button id="submit" type="submit" value="submit" name="supprimerUtilisateur">Oui</button>
            <button><a href="?requete=cellier">Non</a></button>
        </div>
    </form>
</div>