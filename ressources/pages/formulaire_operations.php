<h1><?= ($edit == true) ? "Editer" : "Ajouter"; ?> une opération</h1>

<form action="" method="post" class="form-group">
<p class="row"><label class="col-sm-2 col-form-label" for="nom">Nom de l'opération : </label><input type="text" class="form-control col-sm-10" id="nom" name="nom" value="<?= $tableau['nom_operation'] ?>" placeholder="Nom de l'opération"></p>
<p class="row"><label class="col-sm-2 col-form-label">Montant : </label><input type="number" class="form-control col-sm-10" name="montant" value="<?= $tableau['montant_operation'] ?>" step="any" placeholder="00,00"></p>
<p class="row"><label class="col-sm-2 col-form-label">Catégorie : </label>
<select id="categorie" name="id_categorie" class="form-control col-sm-10">
<?php
while($categorie = $req_listing_cat->fetch())
{
?>
  <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie["nom_categorie"]; ?> (<?= $categorie['type_transaction']; ?>)</option>
<?php
}
?>
</select></p>
<p class="row"><label class="col-sm-2 col-form-label">Compte :</label>
<select id="compte" name="compte" class="form-control col-sm-10">
<?php
while($cb = $req_listing_cb->fetch())
{
?>
  <option value="<?= $cb['id_cb']; ?>"><?= $cb['nom_compte']; ?> (Compte <?= ($cb["type_compte"] == "compte_joint") ? "joint": $cb["type_compte"]; ?>) - SOLDE : <?= $cb["solde"] . " " . $cb['devise']; ?></option>
<?php
}
?>
</select></p>
<p><input type="submit" class="btn btn-primary"  name="operation" /></p>

</form>
<hr />