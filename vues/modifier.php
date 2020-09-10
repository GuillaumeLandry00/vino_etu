<div class="modifier">

    <div class="modifierBouteille" vertical layout>
    <h3>Modifier: <?= $data[0]['nom']?></h3>
    <h4>ID: <span id="id_bouteille"><?= $data[0]['vino__bouteille_id']?></span></h4>
        <div >
                <p>Millesime : <input value="<?= $data[0]['millesime']?>" name="millesime"><span style="color:red"id="errMillesime"></span></p>
                <p>Quantite : <input  value="<?= $data[0]['quantite']?>" name="quantite" value="1"><span style="color:red"id="errQt"></span></p>
                <span style="color:red"id="errDate"></span>
                <p>Date achat : <input value="<?= $data[0]['date_achat']?>" type="date" name="date_achat"></p>
                <p>Garde : <input value="<?= $data[0]['garde_jusqua']?>" type="date" name="garde_jusqua"></p>
                <p>Prix : <input value="<?= $data[0]['prix']?>" name="prix"><span style="color:red"id="errPrix"></span></p>
                <p>Notes <input  value="<?= $data[0]['notes']?>" name="notes"></p>
            </div>
            <button name="modifierBouteilleCellier">Modifier la bouteille</button>
            <span id="confirmation"></span>
        </div>
    </div>
</div>