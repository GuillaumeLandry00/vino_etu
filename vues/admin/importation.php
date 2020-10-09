
<div class="container-importations">
    <h2>Importation de bouteille</h2>
    <form action="" method="post">
        <label for="produit">Nombre bouteille \ importer</label>
        <select name="produit" id="">
            <option value="24" <?php if (isset($nombreProduit) && $nombreProduit==24) echo "selected"?>>24</option>
            <option value="48" <?php if (isset($nombreProduit) && $nombreProduit==48) echo "selected"?>>48</option>
            <option value="96" <?php if (isset($nombreProduit) && $nombreProduit==96) echo "selected"?>>96</option>
        </select>
        <label for="page">Nombre de page \ importer</label>
        <input type="number" min='1' value='<?= (isset($page) ) ? $page : "1"?>' name='page'>
        <label for="type">Type de vin</label>
        <select name="type" id="">
            <option value="rouge" <?php if (isset($type) && $type=="rouge") echo "selected"?>>Vin Rouge</option>
            <option value="blanc" <?php if (isset($type) && $type=="blanc") echo "selected"?>>Vin Blanc</option>
        </select>
        <button name="submit" type="submit">Importer</button>
    </form>
    <?php if(!empty($data)):?>
        <h4>Nombre de bouteille importé: <?= count($data)?></h4>
        <table>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Code saq</th>
            <th>Pays</th>
            <th>Prix</th>
            <th>Retour</th>
        </tr>

        <?php foreach($data as $key => $item): ?>
       
        <tr>
            <td><?= $i++ ?></td>
            <td><?= utf8_encode ($item['nom']) ?></td>
            <td><?= $item['code_SAQ'] ?></td>
            <td><?= utf8_encode ($item['pays']) ?></td>
            <td><?= $item['prix'] ?></td>
            <td style="color:<?= $item['raison'] === "duplication" ? "red" : "green" ?>"><?= $item['raison'] ?></td>
        </tr>
            
        <?php endforeach;?>
        </table>
    <?php endif; ?>
</div>