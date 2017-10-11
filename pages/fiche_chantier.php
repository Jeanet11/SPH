<?php
//recupération de l'id du chantier
$id_chantier = htmlspecialchars((int)$_GET["id"]);
//include de la page de connexion a la bdd ($bdd)
include('assets/templates/tryCatch.php');
//requete sql pour récupéré les informations du chantier
$sql_info_chantier = sprintf("SELECT *,DATE_FORMAT(tra_date_debut, '%%d/%%m/%%Y') AS date  FROM tra_travaux WHERE tra_oid = %d",$id_chantier);
//execute la requete sql du chantier
try
{
    $result_info_chantier = $bdd->query($sql_info_chantier)->fetch();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};

//recupere l'id client du chantier
$id_client = $result_info_chantier["cli_oid"];
//requete sql pour récupéré les informations du client
$sql_info_client = sprintf("SELECT cli_nom, cli_prenom FROM cli_client WHERE cli_oid = %d",$id_client);
//execute la requete sql du client
try
{
    $result_info_client = $bdd->query($sql_info_client)->fetch();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};


?>
<div class="container">
    <ul class="list-inline col-sm-12">
        <li class="list-group-item">Ref client : <?= $id_client ?></li>
        <li class="list-group-item"><?= $result_info_client["cli_nom"] ?></li>
        <li class="list-group-item"><?= $result_info_client["cli_prenom"] ?></li>
    </ul> 
    <ul class="list-group col-sm-2 hidden-xs">
        <li class="list-group-item">Titre</li>
        <li class="list-group-item">Description</li>
        <li class="list-group-item">Prix</li>
        <li class="list-group-item">Date</li>
        <li class="list-group-item">Moyen de paiement</li>
    </ul>
    <ul class="list-group col-sm-4 col-xs-12">
        <li class="list-group-item"><?= $result_info_chantier["tra_titre"] ?></li>
        <li class="list-group-item"><?= $result_info_chantier["tra_description"] ?></li>
        <li class="list-group-item"><?= $result_info_chantier["tra_prix"] ?>€</li>
        <li class="list-group-item"><?= $result_info_chantier["date"] ?></li>
        <li class="list-group-item"><?= $result_info_chantier["tra_mode_paiment"] ?></li>
    </ul> 
    <ul class="list-group col-sm-4 col-xs-12">
        <textarea disabled class="list-group-item col-xs-12" rows="9"><?= $result_info_chantier["tra_description"] ?></textarea>
    </ul> 
    <ul class="list-inline col-sm-12">
        <li class="list-group-item"><a class="btn btn-warning" href="?p=pdf&id=<?= $id_chantier ?>&type=devis" target="_blank">Devis</a></li>
        <li class="list-group-item"><a class="btn btn-warning" href="?p=pdf&id=<?= $id_chantier ?>&type=facture" target="_blank">Facture</a></li>
        <li class="list-group-item"><a class="btn btn-warning" href="?p=pdf&id=<?= $id_chantier ?>&type=pv" target="_blank">PV</a></li>
        <li class="list-group-item"><a class="btn btn-warning" href="?p=pdf&id=<?= $id_chantier ?>&type=garantie" target="_blank">Garantie</a></li>
        <li class="list-group-item"><a class="btn btn-warning" href="?p=photo&id=<?= $id_chantier ?>" target="_blank">Photos</a></li>        
    </ul> 
</div>

