<?php

//     ______          ___                ______           __                  
//   / ________  ____/ (_____  ____ _   / ________ ______/ /_____  _______  __
//  / /   / __ \/ __  / / __ \/ __ `/  / /_  / __ `/ ___/ __/ __ \/ ___/ / / /
// / /___/ /_/ / /_/ / / / / / /_/ /  / __/ / /_/ / /__/ /_/ /_/ / /  / /_/ / 
// \____/\____/\__,_/_/_/ /_/\__, /  /_/    \__,_/\___/\__/\____/_/   \__, /  
//                          /____/                                   /____/   
//
// Team : Paul Derue, Jarno Rameter, Cédric Leprohon, Damien Jisseau
// Thanks to "Jean-Michel PO"


require_once "fonctions/header.php";


$bdd = connexion_bdd();

$edit = false;
$tableau = array(
    "nom_operation" => NULL,
    "montant_operation" => NULL,
    "id_categorie" => NULL,
    "compte" => NULL
);

if(isset($_GET['editer'])){

    $id_operation = intval($_GET['editer']);

    if(is_int($id_operation))
    {
        $edit = true;

        $req = $bdd->prepare("SELECT * FROM operation WHERE id_operation = ?");
        $req->execute(array($id_operation));

        $data = $req->fetch();
        $tableau['nom_operation'] = $data['nom_operation'];
        $tableau['montant_operation'] = $data['montant_operation'];
        $tableau['id_categorie'] = $data['id_categorie'];
        $tableau['compte'] = $data['id_cb'];
    }
}

if(isset($_POST['operation']))
{
    // Les variables
    $nom = htmlspecialchars($_POST['nom']);
    $montant = htmlspecialchars($_POST['montant']);
    $categorie = htmlspecialchars($_POST['id_categorie']);
    $compte = htmlspecialchars($_POST['compte']);


    // Les conditions
    
    if($nom != NULL &&
    $montant != NULL &&
    $categorie != NULL &&
    $compte != NULL)
    {
        if(is_numeric($montant)) {


            // On veut savoir si c'est un débit ou un crédit, 
            // le problème : c'est qu'on peut le savoir uniquement grâce à la table categorie
            // Solution: faire une requête dans la table categorie
            
            $req1 = $bdd->prepare("SELECT type_transaction FROM categorie 
            WHERE id_categorie = ?");
            $req1->execute (array(
                $categorie
            ));

            $data_cat = $req1->fetch();


            // On souhaite savoir le solde du compte bancaire
            // Problème: il se situe dans le compte_bancaire (table)
            // Solution: faire une requête dans le compte bancaire

            $req2 = $bdd->prepare("SELECT solde FROM compte_bancaire 
            WHERE id_cb = ?");
            $req2->execute (array(
                $compte
            ));

            $req2 = $req2->fetch();

            $solde = $req2["solde"]; // This is the solde

            // Voudrais-t-on éditer ou modifier l'opération ??

            if($edit) {
                
                // ON SOUHAITE MODIFIER
                // on récupère le montant de l'opération actuelle
                $req_op = $bdd->prepare("SELECT montant_operation FROM operation WHERE id_operation = ?");
                $req_op->execute(array($id_operation));
                $req_op = $req_op->fetch();
                
                $ancien_montant_operation = $req_op["montant_operation"];

                /**
                 * EXEMPLE CONCRET:
                 * On part du principe que le solde est de 100€
                 * On fais une transaction de 10€(debit) donc le SOLDE est à 90e
                 * MAIS on s'est gourré 
                 * c'est pas 10€ mais 11€
                 * donc le solde doit changer en conséquence
                 * pour un débit
                 * NOUVEAU SOLDE = ANCIEN SOLDE + montant de l'opération erronée - le nouveau montant de la transaction
                 * pour un crédit :
                 * NOUVEAU SOLDE  = ANCIEN SOLDE - montant de l'opération merdique + le nouveau montant de la transaction
                 */

                if($data_cat["type_transaction"] == "debit")
                {
                    
                    $solde = ($solde + $ancien_montant_operation) - $montant;
                }else {
                    $solde = ($solde - $ancien_montant_operation) + $montant;
                }
                
                
                // On update l'opération

                $req = $bdd->prepare("UPDATE operation
                SET nom_operation = :nom_operation, montant_operation = :montant_operation, id_categorie = :id_categorie, id_cb = :id_cb
                WHERE id_operation = :id_operation");

                $req->execute (array(
                    "nom_operation" => $nom,
                    "montant_operation" => $montant,
                    "id_categorie" => $categorie,
                    "id_cb" => $compte,
                    "id_operation" => $id_operation));

                echo "<div class='alert alert-success'>L'opération a été modifiée.</div>";

            }else{
                // ON SOUHAITE AJOUTER
                $req = $bdd->prepare("INSERT INTO operation(id_cb,id_categorie,nom_operation,montant_operation)
                VALUES (:id_cb,:id_categorie,:nom_operation,:montant_operation);");
                $req->execute(array(
                "id_cb" => $compte,
                "id_categorie" => $categorie,
                "nom_operation" => $nom,
                "montant_operation" => $montant));

                if($data_cat["type_transaction"] == "debit")
                {
                    $solde = $solde - $montant;
                }else {
                    $solde = $solde + $montant;
                }
                
                echo "<div class='alert alert-success'>L'opération a été ajoutée.</div>";
            }


           $req->closeCursor();

            // On met à jour le solde

            $update = $bdd->prepare("UPDATE compte_bancaire SET solde=:solde 
            WHERE id_cb = :id_cb");
            $update->execute(array(
                "solde" => $solde,
                "id_cb" => $compte
            ));

        }else {
            echo "<div class='alert alert-warning'>Le montant n'est pas un chiffre numérique</div>";
        }
    }else {
        echo "<div class='alert alert-warning'>Un champ est vide.</div>";
    }
}

if(isset($_GET['supprimer'])){
	
	$id_operation = intval($_GET['supprimer']);

	if(is_int($id_operation)) // On vérifie si le champ est numérique
	{
        // On souhaite mettre à jour le solde MAIS AVANT on récupère les données des tables opération et categorie
        $req_maj = $bdd->prepare("SELECT operation.montant_operation, operation.id_cb, categorie.type_transaction 
            FROM operation 
            INNER JOIN categorie ON operation.id_categorie = categorie.id_categorie
            WHERE id_operation = ?");
        $req_maj->execute(array(
            $id_operation
        ));
        $req_maj = $req_maj->fetch();

        // Récupération le solde du compte bancaire
        $cb = $bdd->prepare("SELECT solde FROM compte_bancaire 
        WHERE id_cb = ?");
        $cb->execute (array($req_maj['id_cb']));
        $cb = $cb->fetch();

        $solde = $cb['solde'];


        if($req_maj["type_transaction"] == "debit")
        {
            $solde = $solde + $req_maj['montant_operation'];
        }else {
            $solde = $solde - $req_maj['montant_operation'];
        }

        // Mise à jour du solde
        $update = $bdd->prepare("UPDATE compte_bancaire SET solde = :solde
        WHERE id_cb = :id_cb");
        $update->execute(array(
            "solde" => $solde,
            "id_cb" => $req_maj["id_cb"]
        )); 

        // Suppression du compte
		$req = $bdd->prepare("DELETE FROM operation
		WHERE id_operation = :id_operation");
		$req->execute(array(
			"id_operation" => $id_operation,
		));

		echo "<div class='alert alert-success'>L'opération a été supprimé.</div>";
	}

}

// Requête afficher la liste des catégories

$req_listing_cat = $bdd->prepare("SELECT * FROM categorie ORDER BY nom_categorie ASC");
$req_listing_cat->execute();

// Requête afficher la liste des comptes bancaires

$req_listing_cb = $bdd->prepare("SELECT * FROM compte_bancaire 
WHERE id_utilisateur = ?
ORDER BY nom_compte ASC");
$req_listing_cb->execute(array($_SESSION['id']));

include("ressources/pages/formulaire_operations.php");
include("ressources/pages/listing_operations.php");

require_once "fonctions/footer.php"; 
?>