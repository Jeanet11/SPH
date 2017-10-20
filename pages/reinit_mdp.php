<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
if ($_SESSION['uti_autorisation'] != 1) {
    header("Location: ?p=liste_chantier");
};
//accès a la BDD
if (empty( $_SESSION["uti_oid_temp"])){
    $_SESSION["uti_oid_temp"] = $_POST['uti_oid_temp']; 
};
include("assets/templates/tryCatch.php");
if (!empty($_POST["mdp_nouveau"])){
    $mdp_nouveau = htmlspecialchars($_POST["mdp_nouveau"]);
    $mdp_nouveau_verif = htmlspecialchars($_POST["mdp_nouveau_verif"]);
    //----------------récupération du mdp actuel
    if($mdp_nouveau !== $mdp_nouveau_verif){
        $erreur = "Les mots de passe ne correspondent pas";
    }else{
        //toutes les verifications sont bonnes :
        $id =  $_SESSION["uti_oid_temp"];
        unset( $_SESSION["uti_oid_temp"]);
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
        header("Location: ?p=liste_chantier");
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