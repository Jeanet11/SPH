<?php
include('parameters.php');
try
{
$bdd = new PDO('mysql:host='.$serveur.';dbname='.$nomBdd.';charset=utf8', $utilisateur, $mdp);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>