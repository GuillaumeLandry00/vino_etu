
<div class="container-importation">
    <h2>Importation de bouteille</h2>
    <form action="" method="post">
        <label for="page">Nombre bouteille \ importer</label>
        <select name="page" id="">
            <option value="24">24</option>
            <option value="48">48</option>
            <option value="96">96</option>
        </select>
        <label for="page">Nombre de page \ importer</label>
        <input type="number" min='1' value='1' name='page'>
        <label for="type">Type de vin</label>
        <select name="type" id="">
            <option value="rouge">Vin Rouge</option>
            <option value="blanc">Vin Blanc</option>
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
            <td><?= $item['nom'] ?></td>
            <td><?= $item['code_SAQ'] ?></td>
            <td><?= $item['pays'] ?></td>
            <td><?= $item['prix'] ?></td>
            <td style="color:<?= $item['raison'] === "duplication" ? "red" : "green" ?>"><?= $item['raison'] ?></td>
        </tr>
            
        <?php endforeach;?>
        </table>
    <?php endif; ?>
</div>