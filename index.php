<?php

require_once "fonctions/header.php";

$bdd = connexion_bdd();

if(isset($_POST['operation']))
{
    // Les variables
    $nom = htmlspecialchars($_POST['nom']);
    $montant = htmlspecialchars($_POST['montant']);
    $compte = htmlspecialchars($_POST['compte']);

    // Les conditions
    
    if($nom != NULL && $montant != NULL && $compte != NULL)
    {
        if(is_numeric($montant)) {
            echo $nom;
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
<label for="nom">Nom de l'opération : </label><input type="text" name="nom" placeholder="Nom de l'opération"><br />
<label>Montant de l'opération : </label><input type="number" name="montant" placeholder="00,00"> €<br />
<label>Compte : </label>
<select id="compte" name="compte">
  <option value="lcl">LCL (compte épargne)</option> 
  <option value="societegeniale" selected>Société Géniale (compte épargne)</option>
</select>
<input type="submit" name="operation" />

</form>
<hr />
<h1>Ma liste d'opération</h1>
    <table>
        <tr>
            <td>#</td>
            <td>Date</td>
            <td>Compte bancaire</td>
            <td>Nom de l'opération</td>
            <td>Montant</td>
            <td>Opérations</td>
        </tr>

        <tr>
            <td>1</td>
            <td>12/12/2012</td>
            <td>LCL</td>
            <td>Overwatch</td>
            <td>100€</td>
            <td>Modifier - Supprimer</td>
        </tr>

    </table>
<?php
require_once "fonctions/footer.php"; 
?>