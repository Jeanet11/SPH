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


?>


<?php

function afficherBlocMois($mois, $annee, $table){
    $num2mois = array(1=>'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet',
    'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    $str = "
        <div class='row'>
        <div class='col-sm-11'>
            <div class='panel panel-default'>
                <div class='panel-heading text-center'>
                    <h3 class='panel-title'>". $num2mois[$mois].' '.$annee." </h3>
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

$tableDebut = "<table class='table'>
    <thead>
        <tr>
            <th>Date</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Cp</th>
            <th>Ville</th>
            <th>Téléphone</th>
        </tr>
    </thead>
    <tbody>";

$tableFin = "
    </tbody>
</table>";
        
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
    <tr>
        <td>" . $donnees['tra_date_debut'] . "</td>
        <td>" . $donnees['cli_nom'] . "</td>
        <td>" . $donnees['cli_prenom'] . "</td>
        <td>" . $donnees['cli_email'] . "</td>
        <td>" . $donnees['cli_cp'] . "</td>
        <td>" . $donnees['cli_ville'] . "</td>
        <td>" . $donnees['cli_tel'] . "</td>
    </tr>";
}
afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);


?>


