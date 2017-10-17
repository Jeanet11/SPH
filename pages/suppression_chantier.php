<?php

//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
// recupère l'id du chantier et celui du client
$id_chantier = htmlspecialchars((int)$_POST["id_suppression_chantier"]);
$id_client = htmlspecialchars((int)$_POST["id_suppression_client"]);
include('assets/templates/tryCatch.php');


if(!empty($_GET)){
    $sql_suppr_chantier = sprintf("DELETE FROM tra_travaux WHERE tra_oid = %d",$id_chantier);

    //execute la requete sql de suppression du chantier
    try
    {
        $bdd->query($sql_suppr_chantier);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };
    // supprime les fichier et dossier associer
    $dossier = dirname(__DIR__)."/documents/".$id_chantier;
    $dir_iterator = new RecursiveDirectoryIterator($dossier);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);
    
    // Suppression de chaque dossier et chaque fichier	du dossier chantier
    foreach($iterator as $fichier){
        $fichier->isDir() ? rmdir($fichier) : unlink($fichier);
    }
    // Supprime du dossier chantier
    rmdir($dossier);
    header("Location: ?p=fiche_client&id=".$id_client);
};