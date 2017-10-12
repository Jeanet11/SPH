<?php
include('parameters.php');
<<<<<<< HEAD
=======

>>>>>>> f79184ef550b72f56456013006982673e30dcc92
try
{
$bdd = new PDO('mysql:host='.$serveur.';dbname='.$nomBdd.';charset=utf8', $utilisateur, $mdp);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
<<<<<<< HEAD
=======

>>>>>>> f79184ef550b72f56456013006982673e30dcc92
?>