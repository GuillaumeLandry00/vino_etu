<div class="listeAchat">
<section class="liste_Achat">
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
    		<div class="bouteille">
				<div class="img">
				 <img src="https:<?php echo $bouteille[$_SESSION['users_id']][0]['image'] ?> " width="50" height="50">
				 </div>
	             <div class="bouteille_info">
	            <div class="description">
				<p class="nom">Nom :<b><?=$bouteille[$_SESSION['users_id']][0]['nom']?></b></p>
				<p class="pays">Pays :<?=$bouteille[$_SESSION['users_id']][0]['pays']?></p>
				<p class="prix">Prix :<?=$bouteille[$_SESSION['users_id']][0]['prix_saq']?></p>
				<p class="quantite">Quantité :<?=$_SESSION['quantite'][$bouteille[$_SESSION['users_id']][0]['id']]?></p>
	            </div>
                <button class="supListe"><a href="?requete=supprimerBouteilleListe&id=<?php echo $bouteille[$_SESSION['users_id']][0]['id']?>"><i class="fas fa-trash-alt"></i>Supprimer</a></button>
	            </div>
              </div> 
		<?php
			   $i++;
		endif;
		
endforeach;
$_SESSION['total'] = $i;
//$_SESSION['total'] = $_SESSION['total'];
if($_SESSION['total']== 0):?>
<div>
        <h3>votre liste d'achat est vide</h3>
    </div>
<?php
endif;
else:
?>
 <div>
        <h3>votre liste d'achat est vide</h3>
    </div>
<?php endif;?>
</section>

</div>