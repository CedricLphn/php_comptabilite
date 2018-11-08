<h1> <?= ($edit) ? "Editer": "Créer"; ?> un compte bancaire virtuel </h1>
<form method="POST" class="form-group" action="">
	<p class="row"><label class="col-sm-2 col-form-label">Nom du compte</label><input type="text" name="nom_du_compte" value="<?= $mon_compte; ?>"  class="form-control col-sm-10" placeholder="Nom du compte"> </p>
	<p class="row"><label class="col-sm-2 col-form-label">Type de compte</label> 
	<select name="type_de_compte"  class="form-control col-sm-10">
		<option value="courant"> Courant </option>
		<option value="epargne"> Epargne </option>
		<option value="compte_joint"> Compte joint </option>
	</select> </p>
	<?php
	if($edit == false) {
	?>
	<p class="row"><label class="col-sm-2 col-form-label">tu ecris solde de compte</label><input type="number" name="solde_compte"  class="form-control col-sm-10" placeholder="00.00" step="any"> </p>
	<?php
	}
	?>
	<p class=""> USD <input type="radio" name="devise" value="USD" "form-check-input">
						 EUR <input type="radio" name="devise" value="EUR">
	</p>
	<p><input type="submit" class="btn btn-primary" value="JDF" name="creation"></p>
</form>
<hr />