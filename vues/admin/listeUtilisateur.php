
<div class="catalogue-admin">
<?php if(!empty($data)):?>
    <form action="" method="post">
    <?php foreach ($data as $cle => $utilisateur) : ?>
        <div class="utilisateur" data-quantite="">
            <div class="img"> 
                <img src="https://c7.uihere.com/files/136/22/549/user-profile-computer-icons-girl-customer-avatar.jpg" width="100" height="100">
            </div>
            <div class="description">
                <p class="nom">ID utilisateur : <?php echo $utilisateur['users_id'] ?></p>
                <p class="quantite">Username : <?php echo $utilisateur['users_login'] ?></p>
                <p class="pays">Type d'utilisateur : <?php echo $utilisateur['users_type'] ?></p>
            </div>
            <button id="submit" type="submit" value="submit" name="ajouterdroit">Ajouter droit admin</button>
        </div>
        <?php endforeach;?>
    </form>
<?php else: ?>	
    <div>
        <p>Vous n'avez pas de bouteille dans ce cellier pour le moment</p>
    </div>
<?php endif;?>
</div>


