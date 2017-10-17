    <?php

    if(!empty($_POST)){

        $nom_delete = htmlspecialchars($_POST["nom"]);
        $prenom_delete = htmlspecialchars($_POST["prenom"]);
        
        
        $sql_delete_client = sprintf('DELETE  FROM cli_client WHERE cli_oid = %d", $id_client', 
    $nom_delete, $prenom_delete ); 
    
    try 
    {

        $bdd->query($Sql_delete_client); 
    }

    catch (Exception $e)
    {

        die ('Erreur : ' .$e->getMessage());
    };
    

};


    ?>