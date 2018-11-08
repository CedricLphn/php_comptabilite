<h1> <?= ($edit) ? "Editer": "Créer"; ?> un compte bancaire virtuel </h1>
<form method="POST" class="form-group" action="">
	<div class="nom_du_compte"> Nom du compte <input type="text" name="nom_du_compte" value="<?= $mon_compte; ?>" placeholder="Nom du compte"> </div>
	<div class="type_de_compte"> Type de compte 
	<select name="type_de_compte">
		<option value="courant"> Courant </option>
		<option value="epargne"> Epargne </option>
		<option value="compte_joint"> Compte joint </option>
	</select> </div>
	<?php
	if($edit == false) {
	?>
	<div class="solde_compte">tu ecris solde de compte <input type="number" name="solde_compte"> </div>
	<?php
	}
	?>
	<div class="devise"> USD <input type="radio" name="devise" value="USD">
						 EUR <input type="radio" name="devise" value="EUR">
	</div>
	<input type="submit" class="btn btn-primary" value="JDF" name="creation">
</form>
<hr />