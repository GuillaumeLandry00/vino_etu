<div class="ajouter">

    <div class="nouvelleBouteille" vertical layout>
        <h3>Souhaitez-vous ajouter un nouveau cellier ?</h3>
         <input type="text" name="nom_bouteille" placeholder="Recherche nom :">
        <ul class="listeAutoComplete">


        </ul>
            <div >
                
                <p><span data-id="" class="nom_bouteille"></span></p>
                <p> <input type="number" min="1" name="millesime" placeholder="Millesime :"> <span style="color:red"id="errMillesime"></span></p>
                <p> <input type="number" name="quantite" value="1" placeholder="Quantite :"> <span style="color:red"id="errQt"></span></p>
                <span style="color:red"id="errDate"></span>
                <p> <input  type="date" name="date_achat" placeholder="Date achat :"></p>
                <p> <input type="number" min="1" name="garde_jusqua" placeholder="Garde :"></p>
                <p> <input  type="number" min="1" step="any"  name="prix" placeholder="Prix :" required>  <span style="color:red"id="errPrix"></span></p>
                
                
                <p> <input name="notes" placeholder="Notes"></p>
                <label for="cellier">Veuillez choisir un cellier : <br></label>
                <select name="cellier" id="cellier"required>
                <?php foreach($celliers as $cellier):?>
                    <option value="<?=$cellier['id']?>">Cellier: <?=(isset($cellier['cellier__nom'])) ? $cellier['cellier__nom'] : $i ?></option>
                <?php $i++; endforeach; ?>
                </select>
            </div>
            <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            <span id="confirmation"></span>
        </div>
    </div>
</div>
