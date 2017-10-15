<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
$num = $_POST['num'];
$id = $_POST['id'];
$chemin = dirname(__DIR__)."/documents/".$id."/photo/".$num.".jpg";
function upload($index, $destination, $maxsize=FALSE, $extensions=FALSE)
{
    //Test1: fichier correctement uploadé
        if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;
    //Test2: taille limite
        if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;
    //Test3: extension
        $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
        if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;
    //Déplacement
        return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);
}

upload($num,$chemin, FALSE, array("jpg","JPG","jpeg","JPEG","png","PNG"));
header("location: ?p=galerie&id=".$id);


?>
