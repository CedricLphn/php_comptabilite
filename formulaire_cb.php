<?php

require_once "fonctions/header.php";

$bdd = connexion_bdd();

if(isset($_POST['creation']))
{

	if($_POST['nom_du_compte'] != NULL && 
	$_POST['type_de_compte'] != NULL && 
	$_POST['solde_compte'] != NULL && 
	$_POST['devise'] != NULL)

	{ 
		$nom_du_compte = $_POST['nom_du_compte'];
		$type_de_compte = $_POST['type_de_compte'];
		$solde_compte = $_POST['solde_compte'];
		$devise = $_POST['devise'];


		if(is_numeric($solde_compte)) {
		
			// Insertion

			$req = $bdd->prepare("INSERT INTO compte_bancaire(id_utilisateur,nom_compte,type_compte,solde,devise) VALUES(:id_utilisateur,:nom_compte,:type_compte,:solde,:devise);");
			$req->execute(array("id_utilisateur" => 1,
			"nom_compte" => $nom_du_compte, 
			"type_compte" => $type_de_compte, 
			"solde" => $solde_compte, 
			"devise" => $devise));

			$req->closeCursor();

			echo "Le compte a été crée.";

		}else {
			echo "Le solde du compte n'est pas un chiffre numérique";
		}
	
	}
	else {echo "Elément manquant";}


}


?>
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
	<input type="submit" value="JDF" name="creation">
</form>
<?php
require_once "fonctions/footer.php";
?>