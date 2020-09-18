<div class="modifier">

    <div class="modifierBouteille" vertical layout>
<<<<<<< HEAD
    <h3 data-id="<?= $data[0]['vino__bouteille_id']?>" id="titre">Modifier: <?= $data[0]['nom']?></h3>
=======
    <h3 id="titre">Modifier: <?= $data[0]['nom']?></h3>
>>>>>>> da03a937f81d4f32f2981dc189d5c158fc749a21
        <div >
                <p>Millesime : <input value="<?= $data[0]['millesime']?>" min="1" name="millesime"><span style="color:red"id="errMillesime"></span></p>
                <p>Quantite : <input  value="<?= $data[0]['quantite']?>" name="quantite" value="1"><span style="color:red"id="errQt"></span></p>
                <span style="color:red"id="errDate"></span>
                <p>Date achat : <input value="<?= $data[0]['date_achat']?>" type="date" name="date_achat"></p>
                <p>Garde : <input value="<?= $data[0]['garde_jusqua']?>" type="number" min="1" name="garde_jusqua"></p>
                <p>Prix : <input value="<?= $data[0]['prix']?>" name="prix"><span style="color:red"id="errPrix"></span></p>
                <p>Notes <input  value="<?= $data[0]['notes']?>" name="notes"></p>
            </div>
            <button name="modifierBouteilleCellier">Modifier la bouteille</button>
            <span id="confirmation"></span>
        </div>
    </div>
</div>