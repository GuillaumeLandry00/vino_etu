
<div class="catalogue-admin">
<?php if(!empty($data)):?>
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
            <button class='droitAdmin'  data-id="<?php echo $utilisateur['users_id'] ?>">Ajouter droit admin</button>
            <button class='droitUtilisateur'  data-id="<?php echo $utilisateur['users_id'] ?>">Retirer droit admin</button>
            <button class='supprimerUtilisateur'><a href="?requete=admin/supprimerUtilisateur&id=<?= $utilisateur['users_id'] ?>">Supprimer Utilisateur</a></button>
        
        </div>
        <?php endforeach;?>
<?php else: ?>	
    <div>
        <p>Vous n'avez pas de bouteille dans ce cellier pour le moment</p>
    </div>
<?php endif;?>
</div>

