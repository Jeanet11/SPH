                                                            <!--PARTIE PHP  -->
<?php

if (!empty($_POST))

{

include('assets/templates/tryCatch.php');

    $id_client = htmlspecialchars($_GET['id']);
    $titre = htmlspecialchars($_POST['nom_du_chantier']);
    $date_debut = htmlspecialchars($_POST['date']); 
    $date_rappel = htmlspecialchars($_POST['date']); 
    $description = htmlspecialchars($_POST['travaux']);
    $mode_de_paiment = htmlspecialchars($_POST['mode_de_paiment']);
    $prix = htmlspecialchars($_POST['montant']);

$sql_creation_chantier = sprintf('INSERT INTO SPH.tra_travaux (cli_oid, tra_titre, tra_date_debut, tra_date_rappel, tra_description, tra_mode_paiment, tra_prix) 
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


    header("Localisation: ?p=creation_chantier");
    
    };
    
$date_mtn = date('Y-m-d');
    
    
    ?>
    

                                <!-- PARTIE HTML -->


<div class="container">
    <form action="" method="post">

  
    <h2 class="text-center">nom du chantier<small><input type="text" class="form-control input-lg" id="nom_du_chantier"  name="nom_du_chantier" value=" "></small></h2>
    
        
        
        <div class="row">
            <div class="col-xs-4"><label class="col-xs-4" for="date">date</label>
            <input type="text" class="form-control input-lg" id="date"  name="date" value="<?=$date_mtn ?>"></div>
            <div class="col-xs-4 col-xs-offset-4"><label class="col-xs-offset-4" for="mode_de_paiment">mode de paiment</label><input type="text" class="form-control input-lg" id="mode_de_paiment"  name="mode_de_paiment" value=" "></div>
            </div>
            
                    
            <div class="row">
                <div class="col-xs-4"><label class="col-xs-4" for="travaux">travaux</label><textarea class="form-control input-lg" id="travaux" name="travaux" rows="5"></textarea></div>
                <div class="col-xs-4 col-xs-offset-4"> 
                <input class="col-xs-offset-4" type="submit" value="envoyer"></div>
            </div>


            <div class ="row">
            <div class="col-xs-4"><label class="col-xs-4" for="montant">montant</label><input type="text" class="form-control input-lg" id="montant" name="montant"></div>
            </div>
            
            
                <div class ="row">
                <div class="col-xs-12"><label class="col-xs-12"  for="notes">notes</label><textarea class="form-control input-lg" id="notes" name="notes" rows="8"></textarea> 
                    </div>
                    </div>
                            
                            
    </form>
</div>      
                                
                    
            

    
    