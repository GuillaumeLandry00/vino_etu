<div class="catalogue-admin">
<button class="btnmailbox">Click for mailbox</button>
<div class="mailbox">
<!-- LE mail a l'administateur -->
<?php if(!empty($dataMsg)): ?>
<div class="message"  style="display: none">
    <?php foreach($dataMsg as $msg):?>
        <div class="container-message">
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
<?php if(!empty($data)):?>
    <form action="" method="post">
    <?php foreach ($data as $cle => $bouteille) : ?>

        <div class="bouteille" data-quantite="">
            <div class="img"> 
                <img src="https:<?php echo $bouteille['image'] ?> " width="100" height="100">
            </div>
            <div class="description">
                <p class="nom">Nom : <?php echo $bouteille['nom'] ?></p>
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
    </form>
<?php else: ?>	
    <div>
        <p>Il n'y pas encore d'utilisateur enregistre</p>
    </div>
<?php endif;?>
</div>

