<div class="supprimer">
    <div class="container-supprimer">
        <h3>Souhaitez-vous vraiment du supprimer la bouteille: <strong style="text-decoration: underline;"><?=(isset($donnee[0]['nom'])) ? $donnee[0]['nom'] :"" ?></strong></h3>
        <button name="supprimerBouteille">Oui</button>
        <button><a href="?requete=cellier">Non</a></button>
        <span id="confirmation"></span>
    </div>
</div>
