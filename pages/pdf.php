<?php
$id = (int)$_GET["id"];
$type = htmlspecialchars($_GET["type"]);
$file = dirname(__DIR__)."/documents/".$id."/pdf/".$type.".pdf";
header('Content-type: application/pdf');
readfile($file);
?>