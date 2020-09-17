<div class="cellier">
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
                <button ><a href="?requete=modifierBouteilleCellier&id=<?php echo $bouteille['vino__bouteille_id']?>">Modifier</a></button>
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


