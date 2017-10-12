<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

    <link rel="icon" href="assets/images/favicon.ico" />
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/connexion.css">
    <link rel="stylesheet" href="assets/css/fiche_client.css">
    <link rel="stylesheet" type="text/css" href="assets/css/recherche_client.css">
    <title>SPH</title>
    
</head>
<body>

<?php
    if($p !== 'connexion') {
        include(__DIR__.'/header.php'); 
        echo $content; 
    } else { 
        echo $content;
    }

    ?>
    
    <script src="node_modules/jquery/dist/jquery.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="././assets/js/recherche_client.js"></script>
</body>
</html>