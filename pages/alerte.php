<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])) {
    header("Location: ?p=connexion");
};
include ('assets/templates/tryCatch.php');
$date1 = date("m") + 1; //plus 1 mois pour la sate actuel
if ($date1 > 12) { //Si le mois est superieur a 12 repasse a 1 (decembre to janvier)
    $date1 = 1;
}
//fonction pour la date actuel + 1 mois
$date = date("Y-$date1-d");

//requete pour l'affichage des alertes
$rappel = $bdd->query('SELECT *,day(tra_date_rappel) 
as jourJ, month(tra_date_rappel) 
as moisJ, year(tra_date_rappel) 
as anneeJ,
day(tra_date_debut)
as jour, month(tra_date_debut)
as mois, year(tra_date_debut)
as annee,
day(tra_date_devis)
as jourD, month(tra_date_devis)
as moisD, year(tra_date_devis)
as anneeD
FROM tra_travaux

INNER JOIN cli_client 
ON tra_travaux.cli_oid = cli_client.cli_oid
WHERE tra_verif = 0
ORDER BY tra_date_debut');
?>

    <!-- Panel d'alerte (RAPPEL) -->
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='panel panel-default'>
                    <div class='panel-heading' id='rappel'>
                        <h3 class='panel-title text-center' id='rappelTitre'>RAPPEL</h3>
                    </div>
                    <div class='panel-body' id='contenu'>
                        <fieldset>
                            <ul class='list-inline hidden-xs' id='columnTab'>
                                <li class='col-sm-2'>Devis du</li>
                                <li class='col-sm-2'>Début chantier</li>
                                <li class='col-sm-2'>Nom</li>
                                <li class='col-sm-2'>Prénom</li>
                                <li class='col-sm-2'>Email</li>
                                <li class='col-sm-2'>Valider</li>

                            </ul>

                            <?php
                            while ($ligne = $rappel->fetch()) {
    
    //Si la date est égale a 11 mois aprés le debut d'un chantier, place le chantier dans RAPPEL
                                if ($date >= $ligne['tra_date_rappel']) {

                                    $test = "    <a href='?p=fiche_client&id=" . $ligne['cli_oid'] . "' class='inLine'>
                <ul class='list-inline'>
                    <li class='col-sm-2 col-xs-3'>"
                                        . $ligne['jourD'] . '/' . $ligne['moisD'] . '/' . $ligne['anneeD'] . "
                    </li>
                    <li class='col-sm-2 col-xs-12'>"
                                        . $ligne['jour'] . '/' . $ligne['mois'] . '/' . $ligne['annee'] . "
                    </li>
                    <li class='col-sm-2 hidden-xs text-uppercase'>"
                                        . $ligne['cli_nom'] . "
                    </li>
                    <li class='col-sm-2 hidden-xs'>"
                                        . $ligne['cli_prenom'] . "
                    </li>
                    <li class='col-sm-2 hidden-xs'>"
                                        . $ligne['cli_email'] . "
                    </li>
                    </a>
                    <li class='col-sm-2 col-xs-12'>



                        
                    <button type='button' class='btn-success' id='mononoke' data-toggle='modal' data-target='#myModal" . $ligne['tra_oid'] . "'><span class='glyphicon glyphicon-ok rond secondary' aria-hidden='true'></span></button>
                    </li>
                </ul>
                <div id='myModal" . $ligne['tra_oid'] . "' class='modal fade' tabindex='-1' role='dialog'>
                <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <h4 class='modal-title'>CONFIRMER LA VALIDATION</h4>
                </div>
                <div class='modal-body'>
                <p>Etes-vous sûr(e) de vouloir valider le chantier du " . $ligne['jour'] . '/' . $ligne['mois'] . '/' . $ligne['annee'] . " ? </p>
                </div>
                <div class='modal-footer'>
                <form method='POST' action=''>
                            <input type='text' name='idtravaux' class='hidden' value='" . $ligne['tra_oid'] . "'>
                                <button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>
                                <button class='btn btn-success' type='submit'>Valider</button>
                        </form>
                                </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            

            ";

                                    echo $test;
                                }
                            }


                            if (!empty($_POST)) {
                                $valeur = $_POST['idtravaux'];

                                $sql_update_chantier = sprintf('UPDATE tra_travaux SET tra_verif = 1 
    WHERE tra_oid = %d', $valeur);
                                $bdd->exec($sql_update_chantier);
                                header('Location: ?p=liste_chantier');

                            }

                            ?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>