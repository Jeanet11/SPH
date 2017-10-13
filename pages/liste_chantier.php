<?php
if (empty($_SESSION['uti_pseudo'])){
    header('Location: index.php');
}
?>
<div class="text-center">
<h3>Liste des chantiers</h3>
</div>


<?php


include('assets/templates/tryCatch.php');

$sql = "SELECT count(tra_oid) as nbArt from tra_travaux";
$data = $bdd->query($sql)->fetch();
$nbArt = (INT)$data['nbArt'];
// var_dump($nbArt);
// echo $nbArt;
// print_r($nbArt);

$perPage = 20;
$nbPage = ceil($nbArt/$perPage);
// echo $nbPage;


if(isset($_GET['d']) && $_GET['d']>0 && $_GET['d']<=$nbPage){
    $cPage = $_GET['d'];
}else{
    $cPage = 1;
}


$reponse = $bdd->query('SELECT *, month(tra_date_debut) 
as mois, year(tra_date_debut) as annee
FROM tra_travaux  INNER JOIN cli_client 
ON tra_travaux.cli_oid = cli_client.cli_oid 
ORDER BY tra_date_debut desc LIMIT '.(($cPage-1)*$perPage).','.$perPage);
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
        <ul class='list-inline hidden-xs' id='columnTab'>
            <li class='col-sm-2'>Date</li>
            <li class='col-sm-2'>Nom</li>
            <li class='col-sm-2'>Prénom</li>
            <li class='col-sm-2'>Email</li>
            <li class='col-sm-2'>Cp</li>
            <li class='col-sm-2'>Ville</li>

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
    <a href='?p=fiche_client&id=".$donnees['cli_oid']."' class='inLine'>
    <ul class='list-inline'>
        <li class='col-sm-2 col-xs-12'>" . $donnees['tra_date_debut'] . "</li>
        <li class='col-sm-2 col-xs-12 hidden-xs text-uppercase'>" . $donnees['cli_nom'] . "</li>
        <li class='col-sm-2 col-xs-12 hidden-xs'>" . $donnees['cli_prenom'] . "</li>
        <li class='col-sm-2 col-xs-12 visible-xs'><span class='text-uppercase'><strong>" . $donnees['cli_nom']. "</strong></span> ". $donnees['cli_prenom'] . "</li>        
        <li class='col-sm-2 col-xs-12'>" . $donnees['cli_email'] . "</li>
        <li class='col-sm-2 col-xs-3''>" . $donnees['cli_cp'] . "</li>
        <li class='col-sm-2 col-xs-8''>" . $donnees['cli_ville'] . "</li>

    </ul>
    <div class='col-xs-12 visible-xs' id='hoverL'></div>
    </a>";
}
afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);
echo "<div class='text-center'>";
for($i=1; $i<=$nbPage; $i++){
if($i==$cPage){
    echo "<span class='mayuri'>$i</span>";
}else{
    echo "<a class='pagination btn btn-success' href=\"?p=liste_chantier&d=$i\">$i</a> ";
    }
}
echo "</div>";
?>
