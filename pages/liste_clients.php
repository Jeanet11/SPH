<?php
if (empty($_SESSION['uti_pseudo'])){
    header('Location: index.php');
}
?>
<div class="text-center">
<h3>Liste des clients</h3>
</div>


<?php


include('assets/templates/tryCatch.php');

$reponse = $bdd->query('SELECT *, month(tra_date_debut) as mois, year(tra_date_debut) as annee
FROM tra_travaux  INNER JOIN cli_client ON tra_travaux.cli_oid = cli_client.cli_oid ORDER BY tra_date_debut desc');

// $reponse = $bdd->query('SELECT * FROM cli_client');
?>


<?php

function afficherBlocMois($mois, $annee, $table){
    $num2mois = array(1=>'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
    'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    $str = "
        <div class='container'>
        <div class='row'>
        <div class='col-sm-12'>
            <div class='panel panel-default'>
                <div class='panel-heading '>
                    <h3 class='panel-title' id='moisTitre'>". $num2mois[$mois].' '.$annee." </h3>
                </div>
                <div class='panel-body'>
                        <fieldset>
                            ". $table . "
                        </fieldset>
                </div>
            </div>
        </div>
        </div>";
    echo $str;
}

$tableDebut = "
        <ul class='list-inline' id='columnTab'>
            <li class='col-sm-1'>Date</li>
            <li class='col-sm-2'>Nom</li>
            <li class='col-sm-2'>Prénom</li>
            <li class='col-sm-2'>Email</li>
            <li class='col-sm-1'>Cp</li>
            <li class='col-sm-2'>Ville</li>
            <li class='col-sm-2'>Téléphone</li>
        </ul>
";

$tableFin = "

</div>";
$curMonth = "";
$curYear = "";
$table = "";
while  ($donnees = $reponse->fetch()){
    if( $curMonth != "" && $curMonth != $donnees['mois']) {
        //Création de la section du mois précédent
        afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);
        $table = "";
    }
    $curMonth = $donnees['mois'];
    $curYear = $donnees['annee'];
    $table .= "
    <a href='#' class='inLine'>
    <ul class='list-inline' id='hoverL'>
        <li class='col-sm-1'>" . $donnees['tra_date_debut'] . "</li>
        <li class='col-sm-2'>" . $donnees['cli_nom'] . "</li>
        <li class='col-sm-2'>" . $donnees['cli_prenom'] . "</li>
        <li class='col-sm-2'>" . $donnees['cli_email'] . "</li>
        <li class='col-sm-1'>" . $donnees['cli_cp'] . "</li>
        <li class='col-sm-2'>" . $donnees['cli_ville'] . "</li>
        <li class='col-sm-2'>" . $donnees['cli_tel'] . "</li>
    </ul>
    </a>";
}
afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);
?>