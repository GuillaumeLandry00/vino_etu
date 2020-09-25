<div class="supprimer">
    <div class="container-supprimer">
        <p>Souhaitez-vous vraiment du supprimer la bouteille:<em><?=(isset($donnee[0]['nom'])) ? $donnee[0]['nom'] :"" ?></em></p>
         <div class="btnSup">
        <button name="supprimerBouteille">Oui</button>
        <button><a href="?requete=cellier">Non</a></button>
        <span id="confirmation"></span>
         </div>
    </div>
</div>
