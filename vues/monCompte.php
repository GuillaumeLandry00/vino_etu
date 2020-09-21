<div class="monCompte">
    <div class="container-monCompte">
        <h2>Gestion de mon compte</h2>
        <form action="" method="POST"></form>
            <div class="modification-compte">
                <h3>Modifier mon compte</h3>
                <label for="nom">Veuillez entrer votre nom: </label>
                <input type="text" name="nom" palceholder="Veuillez entrer un nom">
                <br>
                <label for="motDePasse">Veuillez entrer votre mot de passe: </label>
                <input type="text" name="motDePasse" placeholder="Veuillez entrer un mot de passe">
                <br>
                <label for="motDePasseConf">Veuillez confirmer votre mot de passe: </label>
                <input type="text" name="motDePasseConf" placeholder="Veuillez confirmer votre mot de passe">
                <br>
                <label for="ancienMotDePasse">Veuillez entrer votre ancien mot de passe: </label>
                <input type="text" name="ancienMotDePasse" placeholder="Veuillez entrer votre ancien mot de passe">
            </div>
            <div class="suppression-compte">
                <h3>Supprimer mon compte</h3>
                <strong>Êtes-vous vraiment sur de vouloir supprimer votre compte
                 vous allez perdre tous vos bouteilles enregistrées et vos cellier</strong>
                 <br>
                <button id="submit" type="submit" value="submit" name="supprimerCellier">Oui</button>
                <button><a href="?requete=cellier">Non</a></button>
            </div>
        </form>
        
    </div>
</div>