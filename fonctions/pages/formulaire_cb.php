<h1> Créer un compte bancaire virtuel </h1>
<form method="POST" action="">
	<div class="nom_du_compte"> Nom du compte <input type="text" name="nom_du_compte" value="<?= $mon_compte; ?>" placeholder="Nom du compte"> </div>
	<?php 
	if($edit == false)
	{
	?>
	<div class="type_de_compte"> Type de compte <select name="type_de_compte">
		<option value="courant"> Courant </option>
		<option value="epargne"> Epargne </option>
		<option value="compte_joint"> Compte joint </option>
	</select> </div>
	<div class="solde_compte">tu ecris solde de compte <input type="number" name="solde_compte"> </div>
	<div class="devise"> USD <input type="radio" name="devise" value="USD">
						 EUR <input type="radio" name="devise" value="EUR">
	</div>
	<?php
	}
	?>
	<input type="submit" value="JDF" name="creation">
</form>
<hr />