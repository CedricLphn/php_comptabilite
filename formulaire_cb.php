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

			// Vérification de 10 comptes bancaires maximums

			$nombre_actuel = $bdd->prepare("SELECT COUNT(id_cb) AS nombre 
			FROM compte_bancaire 
			WHERE id_utilisateur = ?");
			$nombre_actuel->execute(array($_SESSION['id']));
			$nombre_actuel = $nombre_actuel->fetch();

			if($nombre_actuel['nombre'] < 10)
			{
			
				// Insertion

			$req = $bdd->prepare("INSERT INTO compte_bancaire(id_utilisateur,nom_compte,type_compte,solde,devise) VALUES(:id_utilisateur,:nom_compte,:type_compte,:solde,:devise);");
			$req->execute(array("id_utilisateur" => $_SESSION['id'],
			"nom_compte" => $nom_du_compte, 
			"type_compte" => $type_de_compte, 
			"solde" => $solde_compte, 
			"devise" => $devise));

			$req->closeCursor();

			echo "Le compte a été crée.";
			}else {
				echo "Impossible de créer plus de dix comptes.";
			}	


		}else {
			echo "Le solde du compte n'est pas un chiffre numérique";
		}
	
	}
	else {
		echo "Elément manquant";
	}


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
<hr />
<h1>Mes comptes bancaires</h1>
    <table>
        <tr>
            <td>#</td>
            <td>Nom du compte</td>
            <td>Type de compte</td>
            <td>Devise</td>
            <td>Opérations</td>
        </tr>

        <tr>
            <td>1</td>
            <td>Swiss Bank</td>
            <td>Epargne</td>
            <td>EUR</td>
            <td>Modifier - Supprimer</td>
        </tr>

    </table>
<?php
require_once "fonctions/footer.php";
?>