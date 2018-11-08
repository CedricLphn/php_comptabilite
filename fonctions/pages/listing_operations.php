<h1>Ma liste d'opération</h1>
    <table width="100%">
        <tr>
            <td>#</td>
            <td>Date</td>
            <td>Compte bancaire</td>
            <td>Nom de l'opération</td>
            <td>Nature de l'opération</td>
            <td>Montant</td>
            <td>Opérations</td>
        </tr>
        <?php
        $affichage_operation = $bdd->prepare("SELECT operation.*, 
        compte_bancaire.nom_compte, 
        categorie.nom_categorie, categorie.type_transaction
        FROM operation
        INNER JOIN compte_bancaire ON operation.id_cb = compte_bancaire.id_cb
        INNER JOIN categorie ON operation.id_categorie = categorie.id_categorie
        ORDER BY operation.id_operation DESC");
        $affichage_operation->execute();
        while($operation = $affichage_operation->fetch()) {
        ?>
        <tr>
            <td><?= $operation['id_operation']; ?></td>
            <td><?= date('d/m/Y', strtotime($operation['date_operation'])); ?></td>
            <td><?= $operation['nom_compte'] ?></td>
            <td><?= $operation['nom_operation'] ?></td>
            <td><?= $operation['nom_categorie'] ?> (<?= $operation['type_transaction']?>)</td>
            <td><?= $operation['montant_operation'] ?></td>
            <td><a class="btn btn-primary" href="index.php?editer=<?= $operation['id_operation']; ?>">Modifier</a> <a href="index.php?supprimer=<?= $operation['id_operation']; ?>" class="btn btn-danger" >Supprimer</a></td>
        </tr>
        <?php
        }
        ?>
    </table>