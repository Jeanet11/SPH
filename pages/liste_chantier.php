<?php
//Securiter en cas de non connexion
if (empty($_SESSION['uti_pseudo'])){
    header('Location: index.php');
}
?>
<div class="text-center">
<h3>Liste des chantiers</h3>
</div>


<?php
include('pages/alerte.php');

?></table><?php
include('assets/templates/tryCatch.php');
//Requete pour la pagination
$sql = "SELECT count(tra_oid) as nbArt from tra_travaux";
$data = $bdd->query($sql)->fetch();
$nbArt = (INT)$data['nbArt'];

$perPage = 20; //Nombre limite d'entrée pour la pagination
$nbPage = ceil($nbArt/$perPage);


//secutiter de la pagination
if(isset($_GET['d']) && $_GET['d']>0 && $_GET['d']<=$nbPage){
    $cPage = $_GET['d'];
}else{
    $cPage = 1;
}




//requete pour l'affichage liste chantier
$reponse = $bdd->query('SELECT *,day(tra_date_debut) 
as jour, month(tra_date_debut) 
as mois, year(tra_date_debut) 
as annee, day(tra_date_devis)
as jourD, month(tra_date_devis) 
as moisD, year(tra_date_devis) 
as anneeD 
FROM tra_travaux  INNER JOIN cli_client 
ON tra_travaux.cli_oid = cli_client.cli_oid 
ORDER BY tra_date_devis desc LIMIT '.(($cPage-1)*$perPage).','.$perPage);



//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};



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
            <li class='col-sm-2'>Devis du</li>
            <li class='col-sm-2'>Début chantier</li>
            <li class='col-sm-2'>Nom</li>
            <li class='col-sm-2'>Prénom</li>
            <li class='col-sm-2'>Email</li>
            <li class='col-sm-2'>Ville</li>
        </ul>
";

$tableFin = "

</div>";
$curMonth = "";
$curYear = "";
$table = "";
while  ($donnees = $reponse->fetch()){
    
    
    
    if( $curMonth != "" && $curMonth != $donnees['moisD'])  {
        //Création de la section du mois précédent
        afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);
        $table = "";
        //Si l'annee courante n'est pas égale à lannée devis, créer un nouveau panel
    }elseif($curYear != "" && $curYear != $donnees['anneeD']){
        afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);
        $table = "";
    }

    
    $curMonth = $donnees['moisD'];
    $curYear = $donnees['anneeD'];
    $table .= "
    <a href='?p=fiche_client&id=".$donnees['cli_oid']."' class='inLine'>
    <ul class='list-inline'>
        <li class='col-sm-2 col-xs-3'>" . $donnees['jourD'] ."/".$donnees['moisD']."/". $donnees['anneeD']. "</li>
        <li class='col-sm-2 col-xs-12'>" . $donnees['jour'] ."/" . $donnees['mois'] . "/" . $donnees['annee'] . "</li>
        <li class='col-sm-2 hidden-xs text-uppercase'>" . $donnees['cli_nom'] . "</li>
        <li class='col-sm-2 hidden-xs'>" . $donnees['cli_prenom'] . "</li>
        <li class='col-xs-12 visible-xs'><span class='text-uppercase'><strong>" . $donnees['cli_nom']. "</strong></span> ". $donnees['cli_prenom'] . "</li>        
        <li class='col-sm-2 col-xs-12'>" . $donnees['cli_email'] . "</li>
        <li class='col-sm-2 col-xs-8''>" . $donnees['cli_ville'] . "</li>
    </ul>
    <div class='col-xs-12 visible-xs' id='hoverL'></div>
    </a>";
    
}

    afficherBlocMois($curMonth, $curYear, $tableDebut.$table.$tableFin);


//Creation de la pagination de manière dinamique
echo "<div class='text-center'>";
for($i=1; $i<=$nbPage; $i++){
    if($i == $cPage){
        echo "<span class='mayuri'>$i</span>";

    }else{
    echo "<a class='pagination btn btn-success' href=\"?p=liste_chantier&d=$i\">$i</a> ";
    
    }
}
echo "</div>";
?>

