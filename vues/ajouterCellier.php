<div class="ajouterCellier">

    <div class="nouveauCellier" vertical layout>
        
    <p>Souhaitez-vous ajouter un nouveau cellier ?</p>
    <form action="" method="post">
        <label for="cellier__nom"></label>
        <input type="text" name='cellier__nom'placeholder="Nom du cellier">
        <button id="submit" type="submit" value="submit">Valider</button>
    </form>
    <span id="confirmation">
     <?php echo $data['retourAjouter']?>
    </span>
    </div>
</div>
