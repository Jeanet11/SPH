<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
//Gestion chantier
//recupération de l'id du chantier
$id_chantier = htmlspecialchars((int)$_GET["id"]);
//include de la page de connexion a la bdd ($bdd)
include('assets/templates/tryCatch.php');
//requete sql pour récupéré les informations du chantier
$sql_info_chantier = sprintf("SELECT *,DATE_FORMAT(tra_date_debut, '%%d/%%m/%%Y') AS date,
DATE_FORMAT(tra_date_devis, '%%d/%%m/%%Y') AS date_devis
FROM tra_travaux WHERE tra_oid = %d",$id_chantier);
//execute la requete sql du chantier
try
{
    $result_info_chantier = $bdd->query($sql_info_chantier)->fetch();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};
//Gestion client
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
//Gestion fichier
//creation d'une fonction pour verifier si il y a un fichier ou non, la cas present il l'ouvre, cas contraire proposition d'upload
function verif_exist ($type, $id){
$file = dirname(__DIR__)."/documents/".$id."/pdf/".$type.".pdf";
if (file_exists($file)) {
    return '<li">
    <ul class="list-inline">
        <li class="list-group-item col-sm-2 col-xs-12 text-uppercase">'.$type.'</li>
        <li class="list-group-item btn btn-success">
            <a class="" href="?p=pdf&id='.$id.'&type='.$type.'" target="_blank">Ouvrir le fichier</a>
        </li>
        <li class="list-group-item">
            <form method="post" action="?p=suppression">
                <input type="hidden" name="type" value="'.$type.'" />
                <input type="hidden" name="id" value="'.$id.'" />
                <!-- MODAL POUR LA SUPRRESSION -->
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$type.'">
                    Supprimer
                </button>
                <div id="myModal'.$type.'" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">SUPPRESSION</h4>
                    </div>
                    <div class="modal-body">
                      <p>Etes-vous sûre de vouloir supprimer le fichier suivant : '.$type.'.pdf ?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                      <input class="btn btn-danger" type="submit" name="submit" value="Supprimer" />
                    </div>
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->
            </form>
        </li>
    </ul>
    </li>';
} else {
    return '<form method="post" action="?p=fichier" enctype="multipart/form-data">
    <li>
    <ul class="list-inline">
    <input type="hidden" name="type" value="'.$type.'" />
    <input type="hidden" name="id" value="'.$id.'" />
    <li class="list-group-item col-sm-2 col-xs-12 text-uppercase">'.$type.'</li>
    <li class="list-group-item"><input type="file" name="'.$type.'" /></li>
    <li class="list-group-item"><input type="submit" name="submit" value="Enregistrer" /></li>
    </ul>
    </li></form>';
};
};
//Gestion commentaire
//affichage commentaire
$sql_affiche_commentaire = sprintf("SELECT * FROM com_commentaire c INNER JOIN uti_utilisateur u ON u.uti_oid=c.uti_oid WHERE c.tra_oid = %d ORDER BY c.com_oid DESC", $id_chantier );
try
{
    $result_affiche_commentaire = $bdd->query($sql_affiche_commentaire)->fetchAll();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};
//ajout de commentaire
if (!empty($_POST)){
    $commentaire = htmlspecialchars($_POST["commentaire"]);
    $sql_ajout_commentaire = sprintf('INSERT INTO com_commentaire (com_commentaire, tra_oid, uti_oid) VALUES ("%s", %d, %d)',$commentaire,$id_chantier,$_SESSION['uti_oid']);
    try
    {
        $bdd->query($sql_ajout_commentaire);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };
    header("Location: ?p=fiche_chantier&id=".$id_chantier);
};
//--------------------------------------HTML------------------------------------------
?>
<div class="container">
<a class="btn btn-success" href="?p=fiche_client&id=<?= $id_client ?>"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> CLIENT</span></a>
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#suppression_chantier">Supprimer</button>

    <section class="col-sm-12 contour">
        <ul class="list-inline col-sm-12">
            <li class="list-group-item">Ref client : <?= $id_client ?></li>
            <li class="list-group-item text-uppercase"><strong><?= $result_info_client["cli_nom"] ?></strong></li>
            <li class="list-group-item"><strong><?= $result_info_client["cli_prenom"] ?></strong></li>
        </ul> 
        <ul class="list-group col-sm-2 hidden-xs">
            <li class="list-group-item"><strong>Nature des travaux</strong></li>
            <li class="list-group-item">Description</li>
            <li class="list-group-item">Prix</li>
            <li class="list-group-item">Date Devis</li>
            <li class="list-group-item">Date Travaux</li>            
            <li class="list-group-item">Moyen de paiement</li>
        </ul>
        <ul class="list-group col-sm-4 col-xs-12">
            <li class="list-group-item text-uppercase" id="titre"><strong><?= $result_info_chantier["tra_titre"] ?></strong></li>
            <li class="list-group-item" id="description"><?= $result_info_chantier["tra_description"] ?></li>
            <li class="list-group-item" id="prix"><?= $result_info_chantier["tra_prix"] ?>€</li>
            <li class="list-group-item" id="date"><?= $result_info_chantier["date_devis"] ?></li>
            <li class="list-group-item" id="date"><?= $result_info_chantier["date"] ?></li>            
            <li class="list-group-item" id="paiement"><?= $result_info_chantier["tra_mode_paiment"] ?></li>
        </ul> 
        <ul class="list-group list-unstyled col-sm-6 col-xs-12">
            <li><label for="note">Note</label></li>        
            <li><textarea disabled id="note" class="list-group-item col-xs-12" rows="8"><?= $result_info_chantier["tra_description"] ?></textarea></li>
        </ul> 
    </section>
    <section class="col-sm-12 contour">
        <ul class="list-group list-unstyled col-sm-6 col-xs-12">
            <?= verif_exist("devis",$id_chantier) ?>
            <?= verif_exist("facture",$id_chantier) ?>
            <?= verif_exist("pv",$id_chantier) ?>
            <?= verif_exist("garantie",$id_chantier) ?>

            <li>
                <ul class="list-inline">
                <li class="list-group-item col-sm-2 col-xs-12 text-uppercase">photos</li>
                <li class="list-group-item btn btn-success"> <a class="color" href="?p=galerie&id=<?= $id_chantier ?>">Acceder aux photos</a></li>
                </ul>
            </li>
        </ul> 
        <form action="" method="post">
            <ul class="list-group list-unstyled col-sm-6 col-xs-12">
                <li><label for="commentaire">Ajouter un commentaire</label></li>
                <li><textarea id="commentaire" class="list-group-item col-xs-12" rows="5" name="commentaire"></textarea></li>
                <li><input class="btn btn-success" type="submit" value="Enregistrer le commentaire"></li>
            </ul> 
        </form>
    </section>
    <section class="col-sm-12 contour">
        <ul class="list-inline list-unstyled col-xs-12">
<?php
    foreach ($result_affiche_commentaire as $value) {
        echo '
        <li class="list-group-item col-xs-2">'.$value["uti_pseudo"].'</li>
        <li class="list-group-item col-xs-10">'.$value["com_commentaire"].'</li>';
    };
?>
        </ul>
    </section>
</div>
<!-- MODAL POUR LA SUPRRESSION -->
<form method="POST" action="?p=suppression_chantier">
        <div id="suppression_chantier" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">CONFIRMER LA SUPPRESSION</h4>
                    </div>
                    <div class="modal-body">
                        <p>Etes-vous sûre de vouloir supprimer ce chantier ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="text" class="hidden" id="id_suppression_chantier" name="id_suppression_chantier" value="<?= $id_chantier ?>"/>
                        <input type="text" class="hidden" id="id_suppression_client" name="id_suppression_client" value="<?= $id_client ?>"/>                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <input class="btn btn-danger" type="submit" name="submit" value="Supprimer" />
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>';
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="assets/js/fiche_chantier.js"></script>
