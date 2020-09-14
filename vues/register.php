<div class="register">
    <div class="register-container" vertical layout>
        <h2>Register</h2>
        <form action="" method = "POST">
            <input type="text" placeholder="Identifiant *" name="identifiant">
            <span class="retourErreur">
                <?php echo $data['identifiantErreur']?>
            </span>
            <br>
            <input type="text" placeholder="motDePasse *" name="motDePasse">
            <span class="retourErreur">
                <?php echo $data['motDePasseErreur']?>
            </span>
            <br>
            <input type="text" placeholder="Confirmation Mot de passe *" name="confirmMotDePasse">
            <span class="retourErreur">
                <?php echo $data['confirmMotDePasseErreur']?>
            </span>
            <br>
            <button id="submit" type="submit" value="submit">Submit</button>

            <p class="options">Alreafy registred <a href="<?php echo BASEURL?>?requete=authentification">Log in</a></p>
        </form>
    </div>
</div>