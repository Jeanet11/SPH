<?php
//-------------------DEBUT TRAITEMENT POUR AFFICHAGE INFO CLIENT ET CHANTIER-------------------
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

//requete sql pour récupéré les infos chantier
$sql_info_chantier = sprintf("SELECT tra_oid, tra_titre, tra_date_debut  FROM tra_travaux WHERE cli_oid = %d ORDER BY tra_date_debut DESC", $id);
//execute la requete sql du chantier
try
{
    $result_info_chantier = $bdd->query($sql_info_chantier)->fetchAll();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};

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
//-------------------FIN AFFICHAGE-------------------
//-------------------DEBUT TRAITEMENT FORM POUR UPDATE CLIENT-------------------
if(!empty($_POST)){
    //définition des varialble récupéré via POST
    $nom_update = htmlspecialchars($_POST["nom"]);
    $prenom_update = htmlspecialchars($_POST["prenom"]);
    $adresse_update = htmlspecialchars($_POST["adresse"]);
    $cp_update = htmlspecialchars($_POST["cp"]);
    $ville_update = htmlspecialchars($_POST["ville"]);
    $tel_update = htmlspecialchars($_POST["tel"]);
    $email_update = htmlspecialchars($_POST["email"]);
    $note_update = htmlspecialchars($_POST["note"]);
    //requete sql pour mettre à jour les infos client
    $sql_update_client = sprintf("UPDATE `SPH`.`cli_client` SET `cli_nom`='%s', `cli_prenom`='%s', 
    `cli_email`='%s', `cli_adresse`='%s', `cli_cp`='%s', `cli_ville`='%s', `cli_tel`='%s', 
    `cli_commentaire`='%s' WHERE `cli_oid`= %d",
    $nom_update, $prenom_update, $email_update, $adresse_update, $cp_update, $ville_update, $tel_update, $note_update, $id );
    //execute la requete sql de l'update client
    try
    {
        $bdd->exec($sql_update_client);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };
    $_SESSION["info_client"] = "Les informations sont mises à jour";
    header("Location: ?p=fiche_client&id=".$id);
};
?>
<!-- HTML -->
<div class="container">
    <form action="" method="post">
        <section class="col-xs-12">
            <div class="row list-group-item ">
                <h3><span class="col-sm-2 hidden-xs"><?= $id ?></span>               
                <span class="col-xs-12 text-center visible-xs"><?= $id." ".$provenance ?></span>
                <input name="nom" class="col-sm-4 col-xs-12 text-center" value="<?= $nom ?>">
                <input name="prenom" class="col-sm-4 col-xs-12 text-center" value="<?=$prenom ?>">
                <span class="col-xs-2 text-right hidden-xs"><?= $provenance ?></span></h3>

            </div>
            <br />
        </section>
        <section class="col-xs-12">
            <div class="col-sm-2 hidden-xs">
                    <label for="adresse" class="list-group-item">Adresse</label>
                    <label for="cp" class="list-group-item">Code Postal</label>
                    <label for="ville" class="list-group-item">Ville</label>
                    <label for="tel" class="list-group-item">Téléphone</label>
                    <label for="mail" class="list-group-item">Email</label>                
            </div>
            <div class="col-sm-4 col-xs-12">
                    <input id="adresse" name="adresse" class="list-group-item col-xs-12" value="<?= $adresse ?>">
                    <input id="cp" name="cp" class="list-group-item col-xs-12" value="<?= $cp ?>">
                    <input id="ville" name="ville" class="list-group-item col-xs-12" value="<?= $ville ?>">
                    <input id="tel" name="tel" class="list-group-item col-xs-12" value="<?= $tel ?>">
                    <input id="email" name="email" class="list-group-item col-xs-12" value="<?= $email ?>">
            </div>
            <div class="col-sm-6 col-xs-12">
                <label for="note">Note</label>
                <textarea name="note" id="note" class="form-control"  rows="8"><?= $note ?></textarea>
            </div>
        </section>
        <div class="text-center visible-xs">
            <input class="btn btn-success" type="submit" value="Enregistrer les modifications du client"><br /><br />
            <a href="#"><button class="btn btn-warning">Ajouter un chantier</button></a>
        </div>
        <section class="col-sm-offset-2 col-sm-6 col-xs-12">
            <?php
            foreach ($result_info_chantier as $value) {
                echo
                    '<a href="?p=fiche_chantier&id='.$value["tra_oid"].'"><ul class="list-inline">
                        <li class="list-group-item col-xs-2">'.$value["tra_oid"].'</li>  
                        <li class="list-group-item col-xs-6">'.$value["tra_titre"].'</li>  
                        <li class="list-group-item col-xs-4">'.$value["tra_date_debut"].'</li>           
                    </ul></a>';
            }
            ?>
        </section>
        <div class="text-right hidden-xs">
            <input class="btn btn-success" type="submit" value="Enregistrer les modifications du client"><br /><br />
            <a href="#"><button class="btn btn-warning">Ajouter un chantier</button></a>
        </div>
    </form>
</div>



