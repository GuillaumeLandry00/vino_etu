<div class="modifier">

    <div class="modifierBouteille" vertical layout>

    <h3 id="titre">Modifier: <?= $data[0]['nom']?></h3>

        <div >
                <p> <input value="<?= $data[0]['millesime']?>" min="1" name="millesime" placeholder="Millesime :"><span style="color:red"id="errMillesime"></span></p>
                <p> <input  value="<?= $data[0]['quantite']?>" name="quantite" value="1" placeholder="Quantite :"><span style="color:red"id="errQt"></span></p>
                <span style="color:red"id="errDate"></span>
                <p> <input value="<?= $data[0]['date_achat']?>" type="date" name="date_achat" placeholder="Date achat :"></p>
                <p> <input value="<?= $data[0]['garde_jusqua']?>" type="number" min="1" name="garde_jusqua" placeholder="Garde :"></p>
                <p> <input value="<?= $data[0]['prix']?>" name="prix" placeholder="Prix :"><span style="color:red"id="errPrix"></span></p>
                <p> <input  value="<?= $data[0]['notes']?>" name="notes" placeholder="Notes"></p>
            </div>
            <button name="modifierBouteilleCellier">Modifier la bouteille</button>
            <span id="confirmation"></span>
        </div>
    </div>
</div>