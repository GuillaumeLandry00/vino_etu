
<div class="container-importation">
    <h2>Statistique général</h2>
	<button id="btnFiltre">Filtre <i class="fas fa-chevron-down"></i></button>
	
	<div id="filtre"> 
    <form id="fitltreForm" action="" method="post">
        <br>
        <label for="tri">Trier par :</label>
        <select name="tri">
            <option value="nbCellier"<?php if (isset($tri) && $tri=="nbCellier") echo "selected";?>>Nombre de cellier</option>
            <option value="nbBouteille"<?php if (isset($tri) && $tri=="nbBouteille") echo "selected";?>>Nombre de bouteille</option>
            <option value="qtTotal"<?php if (isset($tri) && $tri=="qtTotal") echo "selected";?>>Quantite total de bouteille</option>
            <option value="qtTotal"<?php if (isset($tri) && $tri=="sumPrix") echo "selected";?>>Somme du cellier</option>
         </select>
        <label for="ordre">Ordre: </label>
        <select name="ordre">
            <option value="ASC"<?php if (isset($ordre) && $ordre=="ASC") echo "selected";?>>ASC</option>
            <option value="DESC"<?php if (isset($ordre) && $ordre=="DESC") echo "selected";?>>DESC</option>
        </select>
        <label for="date">Date d'inscription est superieur</label>
        <input type="date" value="<?php if (isset($date)) echo $date?>" name="date">
        <button class='trier'>Trier</button>
    </form>
	
	</div> 
    <?php if(!empty($data)):?>
        <table>
        <tr>
            <th>Username</th>
            <th>Nombre de celliers</th>
            <th>Nombre de bouteilles</th>
            <th>Quantite Total de bouteille</th>
            <th>Prix total du cellier</th>
        </tr>

        <?php foreach($data as $key => $item): ?>
       
        <tr>
            <td><?= $item['users_login'] ?></td>
            <td><?= $item['nbCellier'] ?></td>
            <td><?= $item['nbBouteille'] ?></td>
            <td><?= $item['qtTotal']  ?></td>
            <td><?= $item['sumPrix'] ?></td>
        </tr>
            
        <?php endforeach;?>
        </table>
    <?php endif; ?>
</div>