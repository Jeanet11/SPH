<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])) {
	header("Location: ?p=connexion");
};
if (!empty($_POST)) {

	include ('assets/templates/tryCatch.php');

	$nom = htmlspecialchars($_POST["recherche"]);
}

$reponse = $bdd->query(sprintf("SELECT * FROM cli_client  WHERE cli_nom LIKE '%%%s%%' ", $nom))->fetchAll();
?>
<div class="container">
<?php
if ((!empty($reponse))):
	foreach ($reponse as $donnees) :
		?>
		<a  href="?p=fiche_client&id=<?= $donnees['cli_oid'] ?>">
			<ul class="list-inline row">
					<li class="list-group-item col-md-offset-1 col-md-1 col-xs-1"> <?= $donnees['cli_oid']; ?></li>
				<li class="list-group-item col-md-3 col-xs-5"> <?= $donnees['cli_nom']; ?></li>
				<li class="list-group-item col-md-2 col-xs-6"> <?= $donnees['cli_prenom']; ?></li>
				<li class="list-group-item col-md-1 col-xs-6"> <?= $donnees['cli_cp']; ?></li>
				<li class="list-group-item col-md-3 col-xs-6"> <?= $donnees['cli_ville']; ?></li>
			</ul>
		</a>	
<?php
	endforeach;
else : echo '<h2 class="text-center">Aucune correspondance trouvée.</h2>';
endif;
?>
	