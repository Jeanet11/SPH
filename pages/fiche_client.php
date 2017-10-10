<?php
//recupération de l'id client
$id = htmlspecialchars((int)$_GET["id"]);

//include de la page de connexion a la bdd ($bdd)
include('assets/templates/tryCatch.php');

//requete sql pour récupéré les informations clients
$sql_info_client = sprintf("SELECT * FROM cli_client WHERE cli_oid = %d",$id);
//execute la requete sql du client
try
{
    $result_info_client = $bdd->query($sql_info_client)->fetch();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};

//requete sql pour récupéré les info chantier
$sql_info_chantier;
//execute la requete sql du chantier
// try
// {
//     $result_info_chantier = $bdd->query($sql_info_chantier)->fetch();
// }
// catch (Exception $e)
// {
//     die('Erreur : ' . $e->getMessage());
// };


//définition des varialble récupéré via la requete SQL
$nom = $result_info_client["cli_nom"];
$prenom = $result_info_client["cli_prenom"];
$provenance = $result_info_client["cli_provenance"];
$adresse = $result_info_client["cli_adresse"];
$cp = $result_info_client["cli_cp"];
$ville = $result_info_client["cli_ville"];
$tel = $result_info_client["cli_tel"];
$email = $result_info_client["cli_email"];
$note = $result_info_client["cli_commentaire"];
?>
<!-- HTML -->
<div class="container">
    <section class="col-xs-12">
        <div class="row list-group-item ">
            <h3><span class="col-xs-2"><?= $id ?></span>
            <span class="col-xs-8 text-center"><?= $nom." ".$prenom ?></span>
            <span class="col-xs-2 text-right"><?= $provenance ?></span></h3>
        </div>
    </section>
    <section class="col-sm-12">
        <div class="col-sm-2 hidden-xs">
            <ul class="list-group">
                <li class="list-group-item">Adresse</li>
                <li class="list-group-item">Code Postal</li>
                <li class="list-group-item">Ville</li>
                <li class="list-group-item">Téléphone</li>
                <li class="list-group-item">Email</li>                
            </ul>
        </div>
        <div class="col-sm-4 col-xs-12">
            <ul class="list-group">
                <li class="list-group-item"><?= $adresse ?></li>
                <li class="list-group-item"><?= $cp ?></li>
                <li class="list-group-item"><?= $ville ?></li>
                <li class="list-group-item"><?= $tel ?></li>
                <li class="list-group-item"><?= $email ?></li>
            </ul>
        </div>
        <div class="col-sm-6 col-xs-12">
            <textarea name="note" id="note" class="form-control"  rows="10"><?= $note ?></textarea>
        </div>
    </section>
</div>





<div class="col-sm-12">
        <a href="#"><button class="btn btn-success">Ajouter un chantier</button></a>
    </div>