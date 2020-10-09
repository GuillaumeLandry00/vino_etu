<div class="modifier">
    <div class="modifierBouteille" vertical layout>
    <h3 id="titre">Modifier: <?= $data[0]['nom']?></h3>
        <div>
                <p> <input value="<?= $data[0]['nom']?>" min="1" name="nom" placeholder="nom"><span style="color:red"id="errNom"></span></p>
                <label for="code_saq">Code saq</label>
                <p> <input  value="<?= $data[0]['code_saq']?>" type="number" name="code_saq" value="1" placeholder="code_saq :"><span style="color:red"id="errSaq"></span></p>
                <label for="pays">Pays</label>
                <p> <input value="<?= $data[0]['pays']?>" type="text" name="pays" placeholder="Pays :"><span style="color:red"id="errPays"></span></p>
                <label for="desc">Description</label>
                <p> <textarea name="desc" placeholder="desc :" ><?= utf8_encode($data[0]['description'])?></textarea></p>
                <label for="format">Prix Saq</label>
                <p> <input value="<?= utf8_encode($data[0]['prix_saq'])?>" name="prix" placeholder="format :"><span style="color:red"id="errPrix"></span></p>
                <label for="format">Format</label>
                <p> <input value="<?= utf8_encode($data[0]['format'])?>" name="format" placeholder="format :"><span style="color:red"id="errFormat"></span></p>
                <!-- <label for="type">Type</label> -->
                <select name="type">
                    <option value="1"<?php if ($data[0]['fk__vino__type_id']== 1 ) echo "selected";?>>Vin rouge</option>
                    <option value="2"<?php if ($data[0]['fk__vino__type_id']== 2 ) echo "selected";?>>Vin blanc</option>
                </select>
            </div>
            <button name="modifierBouteilleCatalogue">Modifier la bouteille</button>
            <span id="confirmation"></span>
        </div>
    </div>
</div>