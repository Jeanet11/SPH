                                                                <!--PARTIE PHP  -->
<?php

if (!empty($_POST))

{

include('assets/templates/tryCatch.php');

    $id_client = htmlspecialchars($_GET['id']);
    $titre = htmlspecialchars($_POST['nom_du_chantier']);
    $date_debut = htmlspecialchars($_POST['date']); 
    $date_rappel = htmlspecialchars($_POST['date']); 
    $description = htmlspecialchars($_POST['notes']);
    $mode_de_paiment = htmlspecialchars($_POST['mode_de_paiment']);
    $prix = htmlspecialchars($_POST['montant']);

$sql_creation_chantier = sprintf('INSERT INTO tra_travaux (cli_oid, tra_titre, tra_date_debut, tra_date_rappel, tra_description, tra_mode_paiment, tra_prix) 
VALUES ("%s", "%s", "%s", "%s" , "%s", "%s", "%s")', $id_client, $titre, $date_debut, $date_rappel, $description, $mode_de_paiment, $prix);

    try 
    {
        // echo $sql_creation_chantier;
        $bdd->query($sql_creation_chantier);
    
    }
    
    
    catch (Exception $e)
    {

        die('erreur: ' .$e->getMessage());

    };  


    header("Location: ?p=fiche_client&id=".$id_client);
    
    };
    
$date_mtn = date('Y-m-d');
    
    ?>
    

                                <!-- PARTIE HTML -->


<div class="container">
    <form action="" method="post">

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <label class="col-sm-offset-4" for="nom_du_chantier">Nature des travaux:</label>
        <input type="text" class="form-control" id="nom_du_chantier"  name="nom_du_chantier" value=" "></div>
    </div><br />
        
        
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label for="date">Date :</label>
                <input type="text" class="form-control" id="date"  name="date" value="<?=$date_mtn ?>">
            </div>
            <div class="col-sm-4  col-xs-6">
                <div class="form-group">
                    <label for="montant">Montant :</label>
                    <div class="input-group">
                    <input name="montant" type="text" class="form-control text-right" id="montant" placeholder="Ex: 1.50">
                    <div class="input-group-addon">€</div>
                    </div>
                </div>
            </div>



            <div class="col-sm-4 col-xs-12">
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
                                
                    
            

    
    