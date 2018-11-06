<?php
if(isset($_POST['nom_du_compte']) && isset($_POST['type_de_compte']) && isset($_POST['solde_compte']) && isset($_POST['devise']))

{

	$nom_du_compte = $_POST['nom_du_compte'];
	$type_de_compte = $_POST['type_de_compte'];
	$solde_compte = $_POST['solde_compte'];
	$devise = $_POST['devise'];

	if($nom_du_compte != NULL && $type_de_compte != NULL && $solde_compte != NULL && $devise != NULL)

	{ 
		if(is_numeric($solde_compte)) {
			echo "Envoyé";
		}else {
			echo "Le solde du compte n'est pas un chiffre numérique";
		}
	
	}
	else {echo "Elément manquant";}


}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Créer un compte bancaire</title>
</head>
<body>
	<h1> Créer un compte bancaire virtuel </h1>

<form method="POST" action="formulaire_cb.php">
	<div class="nom_du_compte"> Nom du compte <input type="text" name="nom_du_compte" placeholder="Nom du compte"> </div>
	<div class="type_de_compte"> Type de compte <select name="type_de_compte">
		<option value="courant"> Courant </option>
		<option value="epargne"> Epargne </option>
		<option value="compte_joint"> Compte joint </option>
	</select> </div>
	<div class="solde_compte">tu ecris solde de compte <input type="number" name="solde_compte"> </div>
	<div class="devise"> USD <input type="radio" name="devise" value="USD">
						 EUR <input type="radio" name="devise" value="EUR">
	</div>
	<input type="submit" value="JDF">
</form>