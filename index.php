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
<<<<<<< HEAD
if($p === 'creation_chantier'){
    include('./pages/creation_chantier.php');
}
=======
if($p === 'liste_chantier'){
    include('./pages/liste_chantier.php');
}


if($p === 'nouveau_client'){
    include('./pages/creation_client.php');
}


if($p === 'fiche_client'){
    include('./pages/fiche_client.php');
}


if($p === 'deconnexion'){
	include('./pages/deconnexion.php');
}

>>>>>>> f79184ef550b72f56456013006982673e30dcc92
$content = ob_get_clean();
include('assets/templates/default.php');
?>

