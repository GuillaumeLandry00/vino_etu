<div class="cellier">
<section class="liste_cellier">
<?php
$i=0;
//$_SESSION['totals']=array();
//var_dump($_SESSION['quantite']);
if (!empty($dataListe)):
	foreach ($dataListe as $cle => $bouteille):
		//var_dump( $cle);
//var_dump(count($bouteille[$_SESSION['users_id']][0]));
		if( !empty($bouteille[$_SESSION['users_id']][0])):
    ?>
				<div class="img">
				 <img src="https:<?php echo $bouteille[$_SESSION['users_id']][0]['image'] ?> " width="50" height="50">
				 </div>
	             <div class="bouteille_info">
	            <div class="description">
				<p class="nom">Nom :<?=$bouteille[$_SESSION['users_id']][0]['nom']?></p>
				<p class="pays">Pays :<?=$bouteille[$_SESSION['users_id']][0]['pays']?></p>
				<p class="prix">Prix :<?=$bouteille[$_SESSION['users_id']][0]['prix_saq']?></p>
				<p class="quantite">Quantité :<?=$_SESSION['quantite'][$bouteille[$_SESSION['users_id']][0]['id']]?></p>
	            </div>
                <button ><a href="?requete=supprimerBouteilleListe&id=<?php echo $bouteille[$_SESSION['users_id']][0]['id']?>">Supprimer</a></button>
	            </div>
               
		<?php
			   $i++;
		endif;
		
endforeach;
$_SESSION['total'] = $i;
//$_SESSION['total'] = $_SESSION['total'];
if($_SESSION['total']== 0):?>
<div>
        <p>votre liste d'achat est vide</p>
    </div>
<?php
endif;
else:
?>
 <div>
        <p>votre liste d'achat est vide</p>
    </div>
<?php endif;?>
</section>

</div>