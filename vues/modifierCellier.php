<div class="modifier">
    <div class="container-modifier">
        <h3>Modifier le cellier: <strong style="text-decoration: underline;"><?=(isset($donnee[0]['cellier__nom'])) ? $donnee[0]['cellier__nom'] :"" ?></strong></h3>
        <br>
        <form action="?requete=modifierCellier&id=<?=$donnee[0]['id']?>" method = "POST">
            <input type="text" name="cellier__nom" value="<?=(isset($donnee[0]['cellier__nom'])) ? $donnee[0]['cellier__nom'] :"" ?>">
            <button id="submit" type="submit" value="submit" name="modifierCellier">Modifier</button>
        </form>
        <br>
        <span id="confirmation">
            <?= $data['retour']?>
        </span>
    </div>
</div>
