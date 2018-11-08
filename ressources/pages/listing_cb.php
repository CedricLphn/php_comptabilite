
<h1>Mes comptes bancaires</h1>
    <table class="table">
    <thead>
        <tr>
            <td scope="col" class="text-center">#</td>
            <td scope="col" class="text-center">Nom du compte</td>
            <td scope="col" class="text-center">Type de compte</td>
            <td scope="col" class="text-center">Solde</td>
            <td scope="col" class="text-center">Devise</td>
            <td scope="col" class="text-center">Opérations</td>
        </tr>
    </thead>
    <tbody>
<?php
        $affichage_cb = $bdd->prepare("
        SELECT * FROM compte_bancaire
        WHERE id_utilisateur = ?
        ");
        $affichage_cb->execute(array($_SESSION['id']));
        while($cb = $affichage_cb->fetch()) {
?>
        <tr>
            <td scope="row"><?= $cb['id_cb']; ?></td>
            <td><?= $cb['nom_compte']; ?></td>
            <td>Compte <?= ($cb['type_compte'] == "compte_joint") ? "joint" : $cb['type_compte']; ?></td>
            <td><?= $cb['solde']; ?></td>
            <td><?= $cb['devise']; ?></td>
            <td class="text-center"><a class="btn btn-primary" href="formulaire_cb.php?editer=<?= $cb['id_cb']; ?>">Modifier</a> <a class="btn btn-danger" href="formulaire_cb.php?supprimer=<?= $cb['id_cb']; ?>">Supprimer</a></td>
        </tr>
<?php
        }
?>
    </tbody>
    </table>