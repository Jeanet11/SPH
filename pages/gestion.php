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






        //requete sql pour ajouter un utilisateur
        $sql_ajout_uti = sprintf('INSERT INTO uti_utilisateur (uti_pseudo, uti_nom, uti_prenom,
        uti_mdp, uti_autorisation) VALUES ("%s", "%s", "%s", "%s", %d)', $pseudo, $nom, $prenom, $mdp, $autorisation);
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
$sql_info_uti = sprintf("SELECT uti_pseudo, uti_nom, uti_prenom, uti_autorisation FROM uti_utilisateur ORDER BY uti_pseudo ASC");
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
    <button id="ajout" class="btn btn-success">Ajouter un utilisateur</button>
    <button id="affiche" class="btn btn-success">Afficher les utilisateurs</button>
    <?php if (!empty($erreur)){
            echo '<h2 class="text-center">'.$erreur.'</h2>';
            };
    ?>
    <form class="" action="" method="post" id="ajout_uti"  
    <?php if (empty($erreur)){ 
            echo 'style="display:none"';
            }; 
            unset($erreur);
    ?>> 
        <ul class="list-group list-unstyled col-sm-offset-4 col-sm-4 col-xs-12 text-center">
            <li class="list-group-item">
                <h2>Ajouter un compte<h2>
            </li>
            <li class="list-group-item">
                <input required class="text-center" required type="text" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php if (!empty($pseudo)){ echo $pseudo; }else{echo "";} ?>">
            </li>        
            <li class="list-group-item">
                <input required class="text-center" type="text" name="nom" id="nom" placeholder="Nom" value="<?php if (!empty($nom)){ echo $nom; }else{echo "";} ?>">
            </li>
            <li class="list-group-item">
                <input required class="text-center" type="text" name="prenom" id="prenom" placeholder="Prénom" value="<?php if (!empty($prenom)){ echo $prenom; }else{echo "";} ?>">
            </li>
            <li class="list-group-item">
                <input required class="text-center" type="password" name="mdp" id="mdp" placeholder="Mot de passe">
            </li>
            <li class="list-group-item">
                <input required class="text-center" type="password" name="mdp_confrim" id="mdp_confrim" placeholder="Confirmer Mot de passe">
            </li>
            <li class="list-group-item">
                <select class="form-control" name="autorisation" id="autorisation">
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
    <div id="affiche_uti" class="col-xs-12"     
    <?php if (empty($uti_ajouter)){ 
            echo 'style="display:none"';
            }; 
            unset($uti_ajouter);
    ?>> 
        <ul class="list-inline">
            <li class="list-group-item col-xs-3"><strong>Pseudo</strong></strong></li>
            <li class="list-group-item col-xs-3"><strong>Nom</strong></li>                                   
            <li class="list-group-item col-xs-3"><strong>Prénom</strong></li>
            <li class="list-group-item col-xs-3"><strong>Type de compte</strong></li>
        </ul>
    <?php
        foreach ($result_liste_utilisateurs as $value) {
            if ($value["uti_autorisation"] == 1) {
                $aut = "Administrateur";
            }elseif($value["uti_autorisation"] == 2){
                $aut = "Utilisateur";
            }
            echo
                '<ul class="list-inline">
                    <li class="list-group-item col-xs-3">'.$value["uti_pseudo"].'</li>
                    <li class="list-group-item col-xs-3">'.$value["uti_nom"].'</li>                                   
                    <li class="list-group-item col-xs-3">'.$value["uti_prenom"].'</li>
                    <li class="list-group-item col-xs-3">'.$aut.'</li>
                </ul>';
        }
        ?>
    </div>
</section>