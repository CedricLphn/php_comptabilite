<h1><?= ($edit == true) ? "Editer" : "Ajouter"; ?> une opération</h1>

<form action="" method="post" class="form-group">
<p><label for="nom">Nom de l'opération : </label><input type="text" name="nom" value="<?= $tableau['nom_operation'] ?>" placeholder="Nom de l'opération"></p>
<p><label>Montant de l'opération : </label><input type="number" name="montant" value="<?= $tableau['montant_operation'] ?>" step="any" placeholder="00,00"> €</p>
<p><label>Catégorie : </label></p>
<select id="categorie" name="id_categorie">
<?php
while($categorie = $req_listing_cat->fetch())
{
?>
  <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie["nom_categorie"]; ?> (<?= $categorie['type_transaction']; ?>)</option>
<?php
}
?>
</select>
<p><label>Compte : </label></p>
<select id="compte" name="compte">
<?php
while($cb = $req_listing_cb->fetch())
{
?>
  <option value="<?= $cb['id_cb']; ?>"><?= $cb['nom_compte']; ?> (Compte <?= ($cb["type_compte"] == "compte_joint") ? "joint": $cb["type_compte"]; ?>)</option>
<?php
}
?>
</select>
<p><input type="submit" class="btn btn-primary"  name="operation" /></p>

</form>
<hr />