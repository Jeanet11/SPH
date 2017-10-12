
                                <!-- PARTIE HTML -->


<div class="container">
    <form action="" method="post">
        
                                
                    <div class="row">
                    <div class="col-md-4">DATE :<input type="text" class="form-control input-lg" id="inputSuccess4" aria-describedby="inputSuccess4Status" name="DATE"></div>
                    <div class="col-md-4 col-md-offset-4">MODE DE REGLEMENT :<input type="text" class="form-control input-lg" id="inputSuccess4" aria-describedby="inputSuccess4Status" name="MODE_DE_REGLEMENT"></div>
                    </div>
                    
                            
                    <div class="row">
                    <div class="col-md-4">TRAVAUX :<textarea class="form-control input-lg" name="TRAVAUX" rows="2"></textarea></div>
                    <div class="col-md-4 col-md-offset-4"><button type="button" class="btn btn-success btn-lg" name= "Enregistrer_le_chantier">Enregistrer le chantier</button></div>
                    </div>
            
            
                    <div class ="row">
                    <div class="col-md-4">MONTANT :<input type="text" class="form-control input-lg" id="inputSuccess4" aria-describedby="inputSuccess4Status" name="Montant"></div>
                    </div>
                    
                    
                        <div class ="row">
                        <div class="control-group">
                            <label class="control-group" for=
                            "inputNote">NOTES :</label>
                            <textarea class="form-control input-lg" name="NOTES" rows="8"></textarea>    
                            </div>
                            </div>
                    
                            </form>
                                </div>
            

            
                                        <!--PARTIE PHP  -->



<?php

if (!empty($_POST))

{

include('assets/templates/tryCatch.php');

    $date_debut = htmlspecialchars($_POST['date de debut']); 
    $description = htmlspecialchars($_POST['description']);
    $mode_de_paiment = htmlspecialchars($_POST['mode de paiment']);
    $facture = htmlspecialchars($_POST['facture']);
    $photos = htmlspecialchars($_POST['photos']); 


$sql_creation_chantier = sprintf("INSERT INTO 'SPH' '.' 'tra_travaux'('tra_date_debut', 'tra_description', 'tra_mode_paiment', 'tra_facture', 'tra_photos') 
VALUES ('%s', '%s', '%s', '%s' , '%s')" ,
    $date_debut, $description, $mode_de_paiment, $facture, $photos);

    try
    {
    
        $bdd->query($sql_creation_chantier);
    
    }
    
    
    catch (Exception $e)
    {

        die('erreur: ' .$e->getMessage());

    };  


    header("Localisation: ?p=creation_chantier");
    
    };
    
    
    
    
    