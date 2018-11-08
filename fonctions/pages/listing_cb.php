
<h1>Mes comptes bancaires</h1>
    <table width="100%">
        <tr>
            <td>#</td>
            <td>Nom du compte</td>
            <td>Type de compte</td>
            <td>Devise</td>
            <td>Opérations</td>
        </tr>
<?php
        $affichage_cb = $bdd->prepare("
        SELECT * FROM compte_bancaire
        WHERE id_utilisateur = ?
        ");
        $affichage_cb->execute(array($_SESSION['id']));
        while($cb = $affichage_cb->fetch()) {
?>
        <tr>
            <td><?= $cb['id_cb']; ?></td>
            <td><?= $cb['nom_compte']; ?></td>
            <td>Compte <?= ($cb['type_compte'] == "compte_joint") ? "joint" : $cb['type_compte']; ?></td>
            <td><?= $cb['devise']; ?></td>
            <td><a class="btn btn-primary" href="formulaire_cb.php?editer=<?= $cb['id_cb']; ?>">Modifier</a> <a class="btn btn-danger" href="formulaire_cb.php?supprimer=<?= $cb['id_cb']; ?>">Supprimer</a></td>
        </tr>
<?php
        }
?>
    </table>