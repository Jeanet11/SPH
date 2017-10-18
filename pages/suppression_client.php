    <?php

    if(!empty($_POST)){
            
        
        $id_client = htmlspecialchars ((int) $_POST["id_suppression_client"]);
        include("assets/templates/tryCatch.php");
        
    };
        
    
    $sql_suppr_client = sprintf('DELETE  FROM cli_client WHERE cli_oid = %d', $id_client); 
    
    try 
    {

        $bdd->query($sql_suppr_client); 
    }

    catch (Exception $e)
    {

        die ('Erreur : ' .$e->getMessage());
    };
    
header("location: ?p=liste_chantier");

