<?php
session_start();



if(isset($_GET['p'])){
    $p = $_GET['p'];
} else{
    $p = 'connexion';
}
ob_start();
if($p === 'connexion'){
    include('./pages/connexion.php');
}

if($p === 'creation_chantier'){
    include('./pages/creation_chantier.php');
}

if($p === 'liste_chantier'){
    include('./pages/liste_chantier.php');
}


if($p === 'nouveau_client'){
    include('./pages/creation_client.php');
}


if($p === 'fiche_client'){
    include('./pages/fiche_client.php');
}

if($p === 'galerie'){
    include('./pages/galerie.php');
}

if($p === 'fiche_chantier'){
    include('./pages/fiche_chantier.php');
}

if($p === 'pdf'){
    include('./pages/pdf.php');
    die;
}

if($p === 'fichier'){
    include('./pages/upload_fichier.php');
    die;
}

if($p === 'up_photo'){
    include('./pages/upload_photo.php');
    die;
}

if($p === 'deconnexion'){
	include('./pages/deconnexion.php');
}
if($p === 'administration') {
	include('./pages/gestion.php');
}

if($p === 'recherche_client') {
	include('./pages/recherche_client.php');
}
if($p === 'suppression') {
	include('./pages/suppression.php');
}
if($p === 'suppression_chantier') {
	include('./pages/suppression_chantier.php');
}
if($p === 'suppression_client') {
	include('./pages/suppression_client.php');
}
if($p === 'update_mdp') {
	include('./pages/update_mdp.php');
}

$content = ob_get_clean();
include('assets/templates/default.php');
?>

