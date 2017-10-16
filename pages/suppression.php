<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
$id = htmlspecialchars((int)$_POST["id"]);
if(!empty($_POST)){
    $type = htmlspecialchars($_POST["type"]);
    $fichier = dirname(__DIR__)."/documents/".$id."/pdf/".$type.".pdf";
    unlink($fichier);
    echo $fichier;
};
header("Location: ?p=fiche_chantier&id=".$id);