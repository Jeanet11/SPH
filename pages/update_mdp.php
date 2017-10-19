<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
//accès a la BDD
include("assets/templates/tryCatch.php");

if (!empty($_POST)){
    $id = $_SESSION['uti_oid']; 
    $mdp_courant = htmlspecialchars($_POST["mdp_actuel"]);
    $mdp_nouveau = htmlspecialchars($_POST["mdp_nouveau"]);
    $mdp_nouveau_verif = htmlspecialchars($_POST["mdp_nouveau_verif"]);
    
    //----------------récupération du mdp actuel
    //creation de la requete sql
    $sql_mdp_actuel = sprintf("SELECT uti_mdp FROM uti_utilisateur WHERE uti_oid = %d", $id);
    //execute la requete sql de l'update client
    try
    {
        $mdp_bdd_actuel = $bdd->query($sql_mdp_actuel)->fetch();
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };

    //ancien mot de passe valide
    if (password_verify($mdp_courant,$mdp_bdd_actuel["uti_mdp"])){
        //COMPARAISON DES 2 NOUVEAUX MDP
        if($mdp_nouveau !== $mdp_nouveau_verif){
            $erreur = "Les mots de passe ne correspondent pas";
        }else{
            //COMPARAISON DE L'ANCIEN ET DU NOUVEAU MDP
            if ($mdp_nouveau === $mdp_courant){
                $erreur = "L'ancien mot de passe et le nouveau mot de passe ne peuvent être identiques'";
            }else{
                //toutes les verifications sont bonnes :
                $mdp_hash = password_hash($mdp_nouveau, PASSWORD_DEFAULT);
                $sql_update_mdp = sprintf('UPDATE uti_utilisateur SET uti_mdp = "%s" WHERE uti_oid = %d', $mdp_hash, $id);
                try
                {
                    $bdd->exec($sql_update_mdp);
                }
                catch (Exception $e)
                {
                    die('Erreur : ' . $e->getMessage());
                };
                session_destroy();
                header("Location: ?p=connexion");
            };
        };
    }else{
        $erreur = "Le mot de passe actuel est invalide";
    };





}

//--------------------------------------------HTML------------------------------------------------
?>
<section class="container">
    <form action="" method="post" class="text-center">
        <h2>Modification du mot de passe</h2>
        <?php
            if (!empty($erreur)){
                echo "<h3>".$erreur."</h3>";
            };
        ?>
        <div class="col-sm-offset-4 col-sm-4 col-xs-12">
            <ul class="list-group list-unstyled">
                <li>
                    <input required class="list-group-item col-xs-12 text-center" type="password" name="mdp_actuel" id="mdp_actuel" placeholder="Mot de passe actuel">
                </li>
                <li>
                    <input required class="list-group-item col-xs-12 text-center"  type="password" name="mdp_nouveau" id="mdp_nouveau" placeholder="Nouveau mot de passe">
                </li>
                <li>
                    <input required class="list-group-item col-xs-12 text-center"  type="password" name="mdp_nouveau_verif" id="mdp_nouveau_verif" placeholder="Confirmer nouveau mot de passe">
                </li>
            </ul>
        </div>
        <div class="col-xs-12 text-center"><br>
            <input class="btn btn-success text-center"  type="submit" value="Enregistrer">
        </div>
    </form>
</section>