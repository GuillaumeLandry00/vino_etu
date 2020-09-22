<div class="supprimer">
    <div class="container-supprimer">
        <h3>Souhaitez-vous vraiment du supprimer le cellier: <strong style="text-decoration: underline;"><?=(isset($donnee[0]['cellier__nom'])) ? $donnee[0]['cellier__nom'] :"" ?></strong></h3>
        <br>
        <form action="" method = "post">
            <button id="submit" type="submit" value="submit" name="supprimerCellier">Oui</button>
            <button><a href="?requete=cellier">Non</a></button>
        </form>
        <br>
       <p> <strong>ATTENTION ceci vas supprimer tous les bouteilles appertenant à ce cellier</strong></p> 
        <span id="confirmation">
            <?= $data['retour']?>
        </span>
    </div>
</div>
