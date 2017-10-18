                                                                <!--PARTIE PHP  -->
<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])) {
    header("Location: ?p=connexion");
};
if (!empty($_POST))

    {
//DATE_FORMAT(tra_date_debut, '%%d/%%m/%%Y')
    include ('assets/templates/tryCatch.php');

    $id_client = htmlspecialchars($_GET['id']);
    $titre = htmlspecialchars($_POST['nom_du_chantier']);
    $date_debut = htmlspecialchars($_POST['date']);
    $date_devis = htmlspecialchars($_POST['date_devis']);    
    $date_rappel = date('Y-m-d',strtotime('+12 month',strtotime($date_debut)));
    $description = htmlspecialchars($_POST['notes']);
    $mode_de_paiment = htmlspecialchars($_POST['mode_de_paiment']);
    $prix = str_replace(',', '.', htmlspecialchars($_POST['montant']));

    $sql_creation_chantier = sprintf('INSERT INTO tra_travaux (cli_oid, tra_titre, tra_date_debut, tra_date_devis, tra_date_rappel, tra_description, tra_mode_paiment, tra_prix, tra_verif) 
VALUES ("%s", "%s", "%s", "%s" , "%s", "%s", "%s", "%s", 0)', $id_client, $titre, $date_debut, $date_devis, $date_rappel, $description, $mode_de_paiment, $prix);
    try
        {
        $bdd->query($sql_creation_chantier);
    } catch (Exception $e)
        {
        die('erreur: ' . $e->getMessage());
    };
    header("Location: ?p=fiche_client&id=" . $id_client);
};
$date_mtn = date('Y-m-d');
?>
                                <!-- PARTIE HTML -->
<div class="container">
    <form action="" method="post">
    <div class="row">
        <div class="col-sm-4 text-center">
            <label class="" for="nom_du_chantier">Nature des travaux:</label>
            <input required type="text" class="form-control" id="nom_du_chantier"  name="nom_du_chantier">
        </div>
        <div class="col-sm-2 col-xs-12 text-center">
            <label for="date_devis">Date Devis :</label>
            <input type="date" class="form-control text-right" id="date_devis"  name="date_devis" value="<?= $date_mtn ?>">
        </div>
        <div class="col-sm-2 col-xs-12 text-center">
            <label for="date">Date Travaux:</label>
            <input type="date" class="form-control text-right" id="date"  name="date" value="<?= $date_mtn ?>">
        </div>
        <div class="col-sm-2 col-xs-6 text-center">
            <div class="form-group">
                <label for="montant">Montant :</label>
                <div class="input-group">
                <input required min="0" step="0.01" name="montant" type="number" class="form-control text-right" id="montant">   
                <div class="input-group-addon">€</div>
                </div>
            </div>
        </div>
        <div class="col-sm-2 col-xs-12 text-center">
            <label for="mode_de_paiment">Moyen de paiment :</label>
            <input type="text" class="form-control" id="mode_de_paiment"  name="mode_de_paiment"></div>
        </div>
        <div class ="row">
        <div class="col-xs-12">
            <label for="notes">Notes :</label>
            <textarea class="form-control" id="notes" name="notes" rows="8"></textarea> 
            </div>
            </div>
            <br />
            <input class="btn btn-success" type="submit" value="envoyer"></div>                     
    </form>
</div>      
                                
                    
            

    
    