<div class="authentification">
    <div class="authentification-container" vertical layout>
        <h2>Sign in</h2>
        <form action="<?php echo BASEURL?>?requete=authentification" method = "POST">
            <input type="text" placeholder="Identifiant *" name="identifiant">
            <span class="retourErreur">
                <?php echo $data['identifiantErreur']?>
            </span>
            <input type="text" placeholder="motDePasse *" name="motDePasse">
            <span class="retourErreur">
                <?php echo $data['motDePasseErreur']?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Not registred yet? <a href="<?php echo BASEURL?>?requete=enregistrement">Create an account</a></p>
        </form>
    </div>
</div>