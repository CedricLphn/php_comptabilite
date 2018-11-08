<?php

require_once "fonctions/header.php";

$bdd = connexion_bdd();

/* On édite le compte bancaire */

$edit = false; // On initialise la varible à false pour pouvoir afficher le formulaire en entier
$mon_compte = NULL; // On met par défaut à NULL pour éviter une erreur lors de la création du compte

if(isset($_GET['editer'])){

	$id_cb1 = intval($_GET['editer']);

	if(is_int($id_cb1))
	{	
		$edit = true;

		$req = $bdd->prepare("SELECT nom_compte FROM compte_bancaire WHERE id_cb = ?");
		$req->execute(array($id_cb1));

		$data = $req->fetch();
		$mon_compte = $data['nom_compte'];

	}
}

/* On soumet le formulaire */


if(isset($_POST['creation']))
{
	if($edit) {
		$mon_compte = $_POST['nom_du_compte'];
		$type = $_POST['type_de_compte'];
		$devise = $_POST['devise'];
		
		$req = $bdd->prepare("UPDATE compte_bancaire SET nom_compte = :nom_compte, 
		type_compte = :type_compte,
		devise = :devise
		WHERE id_cb = :id_cb AND id_utilisateur = :id_utilisateur");
		$req->execute (array(
			"nom_compte" => $mon_compte,
			"type_compte" => $type,
			"devise" => $devise,
			"id_cb" => $_GET['editer'],
			"id_utilisateur" => $_SESSION['id']
		));

		echo "<div class='alert alert-success'>Le compte a été édité.</div>";

	}else {

		if($_POST['nom_du_compte'] != NULL && 
		$_POST['type_de_compte'] != NULL && 
		$_POST['solde_compte'] != NULL && 
		$_POST['devise'] != NULL) // On vérifie si les champs sont NULL

		{ 

			$nom_du_compte = htmlspecialchars($_POST['nom_du_compte']);
			$type_de_compte = htmlspecialchars($_POST['type_de_compte']);
			$solde_compte = htmlspecialchars($_POST['solde_compte']);
			$devise = htmlspecialchars($_POST['devise']);


			if(is_numeric($solde_compte)) { // On vérifie si le solde tapé est numérique

				// Vérification de 10 comptes bancaires maximums

				$nombre_actuel = $bdd->prepare("SELECT COUNT(id_cb) AS nombre 
				FROM compte_bancaire 
				WHERE id_utilisateur = ?"); // On prépare la recette
				$nombre_actuel->execute(array($_SESSION['id']));
				$nombre_actuel = $nombre_actuel->fetch(); 

				$nombre_actuel = $nombre_actuel['nombre'];

				if($nombre_actuel < 10)
				{
				
					// Insertion

					$req = $bdd->prepare("INSERT INTO compte_bancaire(id_utilisateur,nom_compte,type_compte,solde,devise) 
					VALUES(:id_utilisateur,:nom_compte,:type_compte,:solde,:devise);");
					$req->execute(array("id_utilisateur" => $_SESSION['id'],
					"nom_compte" => $nom_du_compte, 
					"type_compte" => $type_de_compte, 
					"solde" => $solde_compte, 
					"devise" => $devise));

					$req->closeCursor();

					echo "<div class='alert alert-success'>Le compte a été crée.</div>";

				}else { // Il y a plus de dix comptes
					echo "<div class='alert alert-danger'>Impossible de créer plus de dix comptes.</div>";
				}	


			}else { // Le solde n'est pas un champ du numérique
				echo "<div class='alert alert-primary'>Le solde du compte n'est pas un chiffre numérique</div>";
			}
		
		}else { // L'élément est manquant
		echo "<div class='alert alert-primary'>Elément manquant</div>";
		}
	}
}

/* On supprime un élément */

if(isset($_GET['supprimer'])){
	
	$id_cb = intval($_GET['supprimer']);

	if(is_int($id_cb)) // On vérifie si le champ est numérique
	{
		$req = $bdd->prepare("DELETE FROM compte_bancaire
		WHERE id_cb = :id_cb AND id_utilisateur = :id_utilisateur;");
		$req->execute(array(
			"id_cb" => $id_cb,
			"id_utilisateur" => $_SESSION['id']
		));

		echo "<div class='alert alert-success'>Le compte a été supprimé.</div>";
	}

}

include("ressources/pages/formulaire_cb.php");
include("ressources/pages/listing_cb.php");
require_once "fonctions/footer.php";
?>