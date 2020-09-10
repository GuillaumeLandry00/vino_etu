<div class="ajouter">

    <div class="nouvelleBouteille" vertical layout>
        Recherche : <input type="text" name="nom_bouteille">
        <ul class="listeAutoComplete">

        </ul>
            <div >
                
                <p>Nom : <span data-id="" class="nom_bouteille"></span></p>
                <p>Millesime : <input type="number" min="1000" max="2999" name="millesime"> <span style="color:red"id="errMillesime"></span></p>
                <p>Quantite : <input type="number" name="quantite" value="1"> <span style="color:red"id="errQt"></span></p>
                <span style="color:red"id="errDate"></span>
                <p>Date achat : <input  type="date" name="date_achat"></p>
                <p>Garde : <input type="date" name="garde_jusqua"></p>
                <p>Prix : <input  type="number" min="1" step="any"  name="prix" required>  <span style="color:red"id="errPrix"></span></p>
                
                
                <p>Notes <input name="notes"></p>
            </div>
            <button name="ajouterBouteilleCellier">Ajouter la bouteille</button>
            <span id="confirmation"></span>
        </div>
    </div>
</div>
