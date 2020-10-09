
<div class="utilisateur-admin">

<button id="btnFiltre">Filtre <i class="fas fa-chevron-down"></i></button>
<div id="filtre"> 
<form id="fitltreForm" id="tri" name="formTri" method="post">
             Nom d'utilisateur :<input type="text" value ="<?=(isset($mot)) ? $mot :"" ?>" name="recherche_utilisateur">
            <label>Trier par</label>
            <select name="typeTri" id="idType">
                <option value="users_login" <?php if (isset($critere) && $critere=="users_login") echo "selected";?>>Username</option>
                <option value="date_inscription"<?php if (isset($critere) && $critere=="date_inscription") echo "selected";?> >Date d'inscription</option>     
            </select>

            <label>Ordre</label>
            <select name="ordre" id ="idOrdre">
                <option value="DESC"<?php if (isset($ordre) && $ordre=="DESC") echo "selected";?>>Decroissant</option>
                <option value="ASC"<?php if (isset($ordre) && $ordre=="ASC") echo "selected";?>>Croissant</option>
            </select> 
            <input id="executer" class="subFiltre"  type="submit" name="tri" value="Executer"> 
    </form>
</div>

<section class="liste_utilisateur">  
<?php if(!empty($data)):?>
    <?php foreach ($data as $cle => $utilisateur) : ?>
        <div class="utilisateur" data-quantite="">
            <div class="img"> 
                <img src="https://c7.uihere.com/files/136/22/549/user-profile-computer-icons-girl-customer-avatar.jpg" width="100" height="100">
            </div>
			<section class="info_user">
            <div class="description">
                <p class="nom">Date inscription : <?php echo $utilisateur['date_inscription'] ?></p>
                <p class="quantite">Username : <?php echo $utilisateur['users_login'] ?></p>
                <p class="pays">Type d'utilisateur : <?php echo $utilisateur['users_type'] ?></p>
            </div>
            <button class='droitAdmin'  data-id="<?php echo $utilisateur['users_id'] ?>">Ajouter droit admin</button>
            <button class='droitUtilisateur'  data-id="<?php echo $utilisateur['users_id'] ?>">Retirer droit admin</button>
            <button class='supprimerUtilisateur'><a href="?requete=admin/supprimerUtilisateur&id=<?= $utilisateur['users_id'] ?>">Supprimer Utilisateur</a></button>
         </section>
        </div>
        <?php endforeach;?>
<?php else: ?>	
    <div>
        <p>Vous n'avez pas de bouteille dans ce cellier pour le moment</p>
    </div>
<?php endif;?>
</section>
</div>


