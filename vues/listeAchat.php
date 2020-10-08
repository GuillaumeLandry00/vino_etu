<div class="cellier">
<section class="liste_cellier">
<?php

if (!empty($dataListe)):
    foreach ($dataListe as $cle => $bouteille):
    ?>
				<div class="img">
				 <img src="https:<?php echo $bouteille[0]['image'] ?> " width="50" height="50">
				 </div>
	             <div class="bouteille_info">
	            <div class="description">
				<p class="nom">Nom :<?=$bouteille[0]['nom']?></p>
				<p class="pays">Pays :<?=$bouteille[0]['pays']?></p>
				<p class="prix">Prix :<?=$bouteille[0]['prix_saq']?></p>
	            </div>
                <button ><a href="?requete=supprimerBouteilleListe&id=<?php echo $bouteille[0]['vino__bouteille_id']?>">Supprimer</a></button>
	            </div>
               
		<?php
endforeach;
else:
?>
 <div>
        <p>votre liste d achat est vide</p>
    </div>
<?php endif;?>
</section>

</div>