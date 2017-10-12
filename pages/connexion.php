<?php 
$password = "";
$row = 1;
    if(isset($_POST)) {
        if(!empty($_POST['co_pseudo']) && !empty($_POST['co_password'])) {
        //Récupération et sécurisation des parametres
        $pseudo = htmlspecialchars($_POST['co_pseudo']);
        $password = $_POST['co_password'];
        //Vérification mot de passe
            include('assets/templates/tryCatch.php');
        //Recherche utilisateur
        $sql = sprintf('SELECT * FROM uti_utilisateur WHERE uti_pseudo = "%s";', $pseudo);
        $response = $bdd->query($sql);
        $row = $response->fetch();
        if($password === $row['uti_mdp']) {
            $_SESSION['uti_pseudo'] = $pseudo;
            $_SESSION['uti_oid'] = $row['uti_oid'];

            header('Location: ?p=liste_chantier');
        } else {
            
        }
        }
    }
?>


<!-- Logo de SPH -->
<div class="container">
<div class="row text-center">
<img class="logo" src="assets/images/homeLogo.png" alt="Logo SPH">
</div>

<!-- Formulaire de login -->
	<div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">Identification</h3>
                </div>
                <div class="panel-body">
                    <form method="post" role="form">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="identifiant" name="co_pseudo" type="text" autofocus required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Mot de passe" name="co_password" type="password" required>
                            </div>
                            <?php
                                if($password != $row['uti_mdp']) {
                                    ?>
                                    <h5 class="text-center text-danger">Identifiants incorrects</h3>
                                    <?php
                                } 
                            ?>
                            <input name="valider" type="submit" class="btn btn-success btn-block" value="Valider">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>