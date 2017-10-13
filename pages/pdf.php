<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
$id = (int)$_GET["id"];
$type = htmlspecialchars($_GET["type"]);
$file = dirname(__DIR__)."/documents/".$id."/pdf/".$type.".pdf";
header('Content-type: application/pdf');
readfile($file);
?>