<?php

$type = $_POST['type'];
$id = $_POST['id'];
$chemin = dirname(__DIR__)."/documents/".$id."/pdf/".$type.".pdf";
$dossier = dirname(__DIR__)."/documents/".$id."/pdf";
function upload($index, $destination, $dossier_destination, $maxsize=FALSE, $extensions=FALSE)
{
    //Test1: fichier correctement uploadé
        if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    //Test2: taille limite
        if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    //Test3: extension
        $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
        if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    //creation du dossier si besoin
        if (!file_exists($dossier_destination)) {
        mkdir($dossier_destination, 0777, true);
    }
    //Déplacement
        return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

upload($type,$chemin, $dossier, FALSE, array("pdf"));
header("location: ?p=fiche_chantier&id=".$id);


?>
