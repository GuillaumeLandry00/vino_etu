<div class="cellier">

<form id="tri" name="formTri" action="<?php echo BASEURL?>?requete=cellier" method="post">
             mot clé :<input type="text" value ="" name="recherche_bouteille">
            <label>Trier par</label>
            <select name="typeTri" id="idType">
                <option value="nom" <?php echo $critere === "nom" ? "selected" : "" ?>>nom</option>
                <option value="type"<?php echo $critere === "type" ? "selected" : "" ?> >type</option>
				<option value="quantite" <?php echo $critere === "quantite" ? "selected" : "" ?>>quantité</option> 
                <option value="pays"<?php echo $critere === "pays" ? "selected" : "" ?>>pays</option>   
                <option value="millesime"<?php echo $critere === "millesime" ? "selected" : "" ?>>millésime</option>             
            </select>

            <label>Ordre</label>
            <select name="ordre" id ="idOrdre">
                <option value="DESC"<?php echo $sens === "DESC" ? "selected" : "" ?>>Decroissant</option>
                <option value="ASC"<?php echo $sens === "ASC" ? "selected" : "" ?>>Croissant</option>
            </select> 
            <input type="submit" name="tri" value="Executer"> 
</form>
<label for="selectCellier">Choisir par cellier</label>
<a href="?requete=cellier">Tous les celliers</a>
<?php foreach($celliers as $cellier):?>
    <a href="?requete=cellier&id=<?= $cellier['id']?>">Cellier: <?=(isset($cellier['cellier__nom'])) ? $cellier['cellier__nom'] : $i ?></a>
<?php $i++; endforeach; ?>

<?php

if(!empty($data)):
    foreach ($data as $cle => $bouteille) :
        
        ?>
            <div class="bouteille" data-quantite="">
            <div class="img"> 
                <img src="https:<?php echo $bouteille['image'] ?> " width="100" height="100">
            </div>
            <div class="description">
                <p class="cellier_nom">Cellier: <?=(isset($bouteille['cellier__nom'])) ? $bouteille['cellier__nom'] : $i ?> </p>
                <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
                <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>
                <p class="prix">Prix : <?php echo $bouteille['prix'] ?></p>
                <p class="notes">Notes : <?php echo $bouteille['notes'] ?></p>
                <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
            </div>
            <div class="options" data-id="<?php echo $bouteille['vino__bouteille_id'] ?>">
                <button ><a href="?requete=modifierBouteilleCellier&id=<?php echo $bouteille['vino__bouteille_id']?>&cellier_id=<?php echo $bouteille['id']?>">Modifier</a></button>
                <button ><a href="?requete=supprimerBouteilleCellier&id=<?php echo $bouteille['vino__bouteille_id']?>&cellier_id=<?php echo $bouteille['id']?>">Supprimer</a></button>
                <button class='btnAjouter'>Ajouter</button>
                <button class='btnBoire'>Boire</button>
                
            </div>
        </div>
    <?php
    endforeach;
else:
?>	
    <div>
        <p>Vous n'avez pas de bouteille dans ce cellier pour le moment</p>
    </div>
<?php endif;?>
</div>


