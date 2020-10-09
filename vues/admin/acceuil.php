<div class="catalogue-admin">

    <button class="btnmailbox">Click for mailbox</button>
    <span style="color: cyan;"><?= (count($dataMsg) > 0 ) ? count($dataMsg) . " nouveau(x) message(s)": ""; ?></span>
    <!-- Modal pour mail -->
    <div id="monModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <div class="message">
            <?php if(!empty($dataMsg)): ?>
                <?php foreach($dataMsg as $msg):?>
                    <div class="container-message" data-idMsg="messageID<?=$i?>">
                        <p>Mail #<?= $i ?></p>
                        <p>De: <?= $msg['users_login']?></p>
                        <p>Message: <?= $msg['message']?></p>
                        <p>Date d'envoie: <?= $msg['date_envoie']?></p>
                        <button data-id="<?= $msg['id']?>"class="supprimerMail">Supprimer le Mail</button>
                    </div>
                <?php $i++;endforeach;
                else:?>
                    <p>Vous n'avez aucun mail</p>
                <?php endif;?>
            </div>
        </div>
    </div>
	<button id="btnFiltre">Filtre <i class="fas fa-chevron-down"></i></button>
	<div id="filtre">
    <form id="fitltreForm" id="tri" name="formTri" method="post">
             Mot clé :<input type="text" value ="<?=(isset($mot)) ? $mot :"" ?>" name="recherche_bouteille">
            <label>Trier par</label>
            <select name="typeTri" id="idType">
                <option value="nom" <?php if (isset($critere) && $critere=="nom") echo "selected";?>>Nom</option>
                <option value="code_saq"<?php if (isset($critere) && $critere=="code_saq") echo "selected";?> >Code_saq</option>
				<option value="prix_saq" <?php if (isset($critere) && $critere=="prix_saq") echo "selected";?>>Prix saq</option> 
                <option value="pays"<?php if (isset($critere) && $critere=="pays") echo "selected";?>>Pays</option>        
            </select>

            <label>Ordre</label>
            <select name="ordre" id ="idOrdre">
                <option value="DESC"<?php if (isset($ordre) && $ordre=="DESC") echo "selected";?>>Decroissant</option>
                <option value="ASC"<?php if (isset($ordre) && $ordre=="ASC") echo "selected";?>>Croissant</option>
            </select> 
            <label for="limit">Nb resultat par page</label>
            <select name="limit" id="limit">
                    <option value="25"<?php if (isset($limit) && $limit==25) echo "selected";?>>25</option>
                    <option value="50"<?php if (isset($limit) && $limit==50) echo "selected";?>>50</option>
                    <option value="75"<?php if (isset($limit) && $limit==75) echo "selected";?>>75</option>
                    <option value="100"<?php if (isset($limit) && $limit==100) echo "selected";?>>100</option>
            </select>
            <input id="executer" class="subFiltre"  type="submit" name="tri" value="Executer"> 
    </form>
	</div> 
	<div class="liste_adminCat">
    <?php if(!empty($data)):?>
        
        <?php foreach ($data as $cle => $bouteille) : ?>

            <div class="bouteille" data-quantite="">
                <div class="img"> 
                    <img src="https:<?php echo $bouteille['image'] ?> " width="100" height="100">
                </div>
                <div class="description">
                    <p class="nom">Nom : <?php echo utf8_encode($bouteille['nom']) ?></p>
                    <p class="quantite">Code Saq : <?php echo $bouteille['code_saq'] ?></p>
                    <p class="pays">Pays : <?php echo $bouteille['pays'] ?></p>
                    <p class="type">Type : <?php echo $bouteille['type'] ?></p>
                    <p class="millesime">Description : <?php echo utf8_encode($bouteille['description']) ?></p>
                    <p class="prix">Prix Saq : <?php echo $bouteille['prix_saq'] ?> </p>
                    <p class="format">format : <?php echo utf8_encode($bouteille['format']) ?></p>
                    <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
                    <button><a href="?requete=admin/modifierBouteille&id=<?= $bouteille['id']?>">Modifier</a></button>
                </div>

            </div>
    <?php endforeach;?>
        
    <?php else: ?>	
        <div>
            <p>Il n'y pas encore de bouteille enregistre</p>
        </div>
    <?php endif;?>
	</div>
</div>

