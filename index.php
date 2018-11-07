<?php

require_once "fonctions/header.php";


$bdd = connexion_bdd();

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

            $req = $bdd->prepare("INSERT INTO operation(id_cb,id_categorie,nom_operation,montant_operation)
            VALUES (:id_cb,:id_categorie,:nom_operation,:montant_operation);");
            $req->execute(array(
            "id_cb" => $compte,
            "id_categorie" => $categorie,
            "nom_operation" => $nom,
            "montant_operation" => $montant));

            $req->closeCursor();
            
            $req1 = $bdd->prepare("SELECT type_transaction FROM categorie 
            WHERE id_categorie = ?");
            $req1->execute (array(
                $categorie
            ));

            $data_cat = $req1->fetch();

            $req2 = $bdd->prepare("SELECT solde FROM compte_bancaire 
            WHERE id_cb = ?");
            $req2->execute (array(
                $compte
            ));

            $req2 = $req2->fetch();

            $solde = $req2["solde"];

            if($data_cat["type_transaction"] == "debit")
            {
                $solde = $solde - $montant;
            }else {
                $solde = $solde + $montant;
            }

            $update = $bdd->prepare("UPDATE compte_bancaire SET solde=:solde 
            WHERE id_cb = :id_cb");
            $update->execute(array(
                "solde" => $solde,
                "id_cb" => $compte
            ));

            echo "L'opération a été ajoutée.";
        }else {
            echo "Le montant n'est pas un chiffre numérique";
        }
    }else {
        echo "Un champ est vide.";
    }
}



?>
<h1>Ajouter une opération</h1>

<form action="index.php" method="post">
<p><label for="nom">Nom de l'opération : </label><input type="text" name="nom" placeholder="Nom de l'opération"></p>
<p><label>Montant de l'opération : </label><input type="number" name="montant" placeholder="00,00"> €</p>
<p><label>Catégorie : </label></p>
<select id="categorie" name="id_categorie">
  <option value="1">Alimentaire</option>
</select>
<p><label>Compte : </label></p>
<select id="compte" name="compte">
  <option value="35">LCL (compte épargne)</option> 
  <option value="36" selected>Société Géniale (compte épargne)</option>
</select>
<p><input type="submit" name="operation" /></p>

</form>
<hr />
<h1>Ma liste d'opération</h1>
    <table>
        <tr>
            <td>#</td>
            <td>Date</td>
            <td>Compte bancaire</td>
            <td>Nom de l'opération</td>
            <td>Nature de l'opération</td>
            <td>Montant</td>
            <td>Opérations</td>
        </tr>
        <tr>
            <td>1</td>
            <td>12/12/2012</td>
            <td>LCL</td>
            <td>Overwatch</td>
            <td>Pute</td>
            <td>100€</td>
            <td>Modifier - Supprimer</td>
        </tr>

    </table>
<?php
require_once "fonctions/footer.php"; 
?>