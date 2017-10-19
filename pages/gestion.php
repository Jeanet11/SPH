<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
if ($_SESSION['uti_autorisation'] != 1) {
    header("Location: ?p=liste_chantier");
};
//include de la page de connexion a la bdd ($bdd)
include ('assets/templates/tryCatch.php');
if (!empty($_POST)) {
//--------------------------------AJOUTER UN UTILISATEUR--------------------------
    $mdp = htmlspecialchars($_POST["mdp"]);
    $mdp_confrim = htmlspecialchars($_POST["mdp_confrim"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $autorisation = htmlspecialchars((int)$_POST["autorisation"]);
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    //---------------Verification du pseudo unique
    //requete pour la verification du pseudo unique
    $sql_pseudo_unique = sprintf('SELECT uti_pseudo FROM uti_utilisateur WHERE uti_pseudo = "%s"',$pseudo);
    //execute la requete pour la verification du pseudo unique
    try
    {
        $result_pseudo_unique = $bdd->query($sql_pseudo_unique)->fetch();
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };

    if ($mdp !== $mdp_confrim) {
        $erreur = 'Les mots de passes de correspondent pas.';
    }elseif (!empty($result_pseudo_unique)) {
        $erreur = 'Ce PSEUDO est déjà utilisé.';
    }else {
        //hash du mot de passe
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);
        //requete sql pour ajouter un utilisateur
        $sql_ajout_uti = sprintf('INSERT INTO uti_utilisateur (uti_pseudo, uti_nom, uti_prenom,
        uti_mdp, uti_autorisation) VALUES ("%s", "%s", "%s", "%s", %d)', $pseudo, $nom, $prenom, $mdp_hash, $autorisation);
        //Exécution de la requete pour ajouter un utilisateur
        try
        {
            $bdd->query($sql_ajout_uti);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        };
        $uti_ajouter = "utilisateur ajouté";
    }
    
}
//--------------------------------LISTE UTILISATEURS--------------------------
//requete pour l'affichage des utilisateurs
$sql_info_uti = sprintf("SELECT uti_oid, uti_pseudo, uti_nom, uti_prenom, uti_autorisation FROM uti_utilisateur ORDER BY uti_pseudo ASC");
//execute la requete pour l'affichage des utilisateurs
try
{
    $result_liste_utilisateurs = $bdd->query($sql_info_uti)->fetchAll();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
};
//--------------------------------AJOUTER UN UTILISATEUR--------------------------
?>
    <section class="container">
        <div class="row  ajout_decal text-center">
            <button id="ajout" class="btn btn-success">Ajouter un utilisateur</button>
            <br class="visible-xs">
            <br class="visible-xs">
            
            <button id="affiche" class="btn btn-success">Afficher les utilisateurs</button>
        </div>
        <br/>
        <?php if (!empty($erreur)){
            echo '<h2 class="text-center">'.$erreur.'</h2>';
            };
    ?>
        <form class="" action="" method="post" id="ajout_uti" <?php if (empty($erreur)){ echo 'style="display:none"'; }; unset($erreur);
            ?>>

            <ul class="list-group list-unstyled col-sm-offset-4 col-sm-4 col-xs-12 text-center">
                <li class="list-group-item">
                    <h2>Ajouter un compte
                        <h2>
                </li>
                <li>
                    <input class="list-group-item col-xs-12 text-center" required required type="text" name="pseudo" id="pseudo" placeholder="Pseudo"
                        value="<?php if (!empty($pseudo)){ echo $pseudo; }else{echo "";} ?>">
                </li>
                <li>
                    <input class="list-group-item col-xs-12 text-center" required type="text" name="nom" id="nom" placeholder="Nom" value="<?php if (!empty($nom)){ echo $nom; }else{echo "";} ?>">
                </li>
                <li>
                    <input class="list-group-item col-xs-12 text-center" required type="text" name="prenom" id="prenom" placeholder="Prénom"
                        value="<?php if (!empty($prenom)){ echo $prenom; }else{echo "";} ?>">
                </li>
                <li>
                    <input class="list-group-item col-xs-12 text-center" required type="password" name="mdp" id="mdp" placeholder="Mot de passe">
                </li>
                <li>
                    <input class="list-group-item col-xs-12 text-center" required type="password" name="mdp_confrim" id="mdp_confrim" placeholder="Confirmer Mot de passe">
                </li>
                <li>
                    <select class="form-control text-center" name="autorisation" id="autorisation">
                        <optgroup label="Niveau d'autorisation">
                            <option value="2">Utilisateur</option>
                            <option value="1">Administrateur</option>
                        </optgroup>
                    </select>
                </li>
                <li class="list-group-item">
                    <input class="btn btn-success" type="submit" value="Enregistrer">
                </li>
            </ul>
        </form>


        <?php//--------------------------------LISTE UTILISATEURS--------------------------?>
            <div id="affiche_uti" class="col-xs-12" <?php if (empty($uti_ajouter)){ echo 'style="display:none"'; }; unset($uti_ajouter);
                ?>>

                <ul class="list-inline titre hidden-xs uti">
                    <li class="list-group-item col-sm-3 col-xs-3 hidden-xs">
                        <strong>Nom</strong>
                    </li>
                    <li class="list-group-item col-sm-3 col-xs-4 hidden-xs">
                        <strong>Prénom</strong>
                    </li>
                    <li class="list-group-item col-sm-3 col-xs-4 hidden-xs">
                        <strong>Pseudo</strong>
                        </strong>
                    </li>
                    <li class="list-group-item col-sm-2 col-xs-1 hidden-xs">
                        <strong>Type de compte</strong>
                    </li>

                </ul>
                <ul class="list-inline titre visible-xs uti">
                    <li class="list-group-item col-sm-3 col-xs-3 visible-xs">
                        <strong>Nom</strong>
                    </li>
                    <li class="list-group-item col-sm-3 col-xs-4 visible-xs">
                        <strong>Prénom</strong>
                    </li>
                    <li class="list-group-item col-sm-3 col-xs-4 visible-xs">
                        <strong>Pseudo</strong>
                        </strong>
                    </li>
                    <li class="list-group-item col-sm-3 col-xs-1 visible-xs">
                        <strong>C</strong>
                    </li>
                </ul>
                <?php
        foreach ($result_liste_utilisateurs as $value) {
            if ($value["uti_autorisation"] == 1) {
                $aut_xs = "A";
                $aut = "Administrateur";
            }elseif($value["uti_autorisation"] == 2){
                $aut_xs = "U";
                $aut = "Utilisateur";
            }
$prenom = $value["uti_prenom"];
$prenom_xs = substr($prenom, 0, 1);
            echo
                ' <a class="lien_mdp" href="#">
             <span class="uti">
                <ul class="list-inline hidden-xs uti">
                    <li class="list-group-item col-sm-3 col-xs-3 hidden-xs"><strong>'.$value["uti_nom"].'</strong></li>                                   
                    <li class="list-group-item col-sm-3 col-xs-4 hidden-xs"><strong>'.$prenom.'</strong></li>
                    <li class="list-group-item col-sm-3 hidden-xs">'.$value["uti_pseudo"].'</li>
                    <li class="list-group-item col-sm-2 hidden-xs">'.$aut.'</li>
                    <li class=" col-sm-1 hidden-xs text-center">
                    <form method="post" action="?p=reinit_mdp">  
                    <input type="text" class="hidden" name="uti_oid_temp" value="'.$value["uti_oid"].'" />
                    <button class="btn reinit-mdp" type="submit" title="Réinitialisation du mot de passe"><span class="glyphicon glyphicon-cog"></span></button>
                    </form>
                    </li>

                </ul></span>

                <ul class="list-inline visible-xs uti">
                <li class="list-group-item col-sm-3 col-xs-3 visible-xs"><strong>'.$value["uti_nom"].'</strong></li>
                <li class="list-group-item col-sm-3 col-xs-4 visible-xs"><strong>'.$prenom_xs.'</strong></li>
                <li class="list-group-item col-sm-3 col-xs-4 visible-xs">'.$value["uti_pseudo"].'</li>
                <li class="list-group-item col-sm-3 col-xs-1 visible-xs">'.$aut_xs.'</li>
            </ul>
</a>
           ';
        }
        ?>
            </div>
    </section>