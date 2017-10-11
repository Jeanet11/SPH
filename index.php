<?php
session_start();

if(isset($_GET['p'])){
    $p = $_GET['p'];
}else{
    $p = 'connexion';
}
ob_start();
if($p === 'connexion'){
    include('./pages/connexion.php');
}
if($p === 'creation_chantier'){
    include('./pages/creation_chantier.php');
}
$content = ob_get_clean();
include('assets/templates/default.php');
?>

