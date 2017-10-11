<?php

if (!empty($_POST)){
    
    include('assets/templates/tryCatch.php');

    $nom = htmlspecialchars($_POST["nom"]);

    // $sql = "SELECT * FROM cli_client";
   
   $reponse=$bdd->query("SELECT * FROM cli_client");
  ?>

<table>
    <thead>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Ville</th>
	</thead>

	<tbody>

<?php
    while($donnees = $reponse->fetch())
			{
?>

		<tr>
			<td> <?=$donnees['cli_nom']; ?></td>
			<td> <?=$donnees['cli_prenom']; ?></td>
			<td> <?=$donnees['cli_ville']; ?></td>
		</tr>


<?php

	}
$reponse->closeCursor();
	?>
	</tbody>
</table>