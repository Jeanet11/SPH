<?php
$id = (int)$_GET["id"];
$type = htmlspecialchars($_GET["type"]);
$file = dirname(__DIR__)."/documents/".$id."/pdf/".$type.".pdf";
echo $file;
header('Content-type: application/pdf');
readfile($file);
?>