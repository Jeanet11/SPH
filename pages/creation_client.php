<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
    header("Location: ?p=connexion");
};
// PARTIE PHP
if (!empty($_POST)){
    //include de la page de connexion a la bdd ($bdd)
    include('assets/templates/tryCatch.php');

    //définition des varialble récupé via la methode POST
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $provenance = htmlspecialchars($_POST["provenance"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $cp = htmlspecialchars($_POST["cp"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $tel = htmlspecialchars($_POST["tel"]);
    $email = htmlspecialchars($_POST["email"]);
    $note = htmlspecialchars($_POST["note"]);

    //Création de la requete SQL pour ajouter le client
    $sql_ajout_client = sprintf("INSERT INTO `cli_client` (`cli_nom`, `cli_prenom`, 
    `cli_email`, `cli_adresse`, `cli_cp`, `cli_ville`, `cli_tel`, `cli_commentaire`, 
    `cli_provenance`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
    $nom, $prenom, $email, $adresse, $cp, $ville, $tel, $note, $provenance);

    //Exécution de la requete
    try
    {
        $bdd->query($sql_ajout_client);
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };

    //Recupère le dernier enregistrement pour la redirection de la page
    //Création de la requete
    $sql_dernier_client = "SELECT cli_oid FROM cli_client ORDER BY cli_oid DESC LIMIT 1";
    //Exécution de la requete
    try
    {
        $result_dernier_client = $bdd->query($sql_dernier_client)->fetch();
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    };
    //Redirection de la page
    header("Location: ?p=fiche_client&id=".$result_dernier_client['cli_oid']);
};

?>
<!-- PARTIE HTML -->
<div class="container">
    <form action="" method="POST">
        <section class="row">
            <div class="form-group col-sm-4">
                <label for="nom">NOM :</label>
                <input required type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
            </div>
            <div class="form-group col-sm-4">
                <label for="prenom">PRENOM :</label>
                <input required type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
            </div>
            <div class="form-group col-sm-4">
            <label for="provenance">Provenance :</label>
                <select id="provenance" name="provenance" class="form-control">
                    <option>WEB</option>
                    <option>Prospection</option>
                </select>
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-8">
                <label for="adresse">ADRESSE :</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-4">
                <label for="cp">CODE POSTAL :</label>
                <input required type="text" class="form-control" id="cp" name="cp" placeholder="Code Postal">
            </div>
            <div class="form-group col-sm-4">
                <label for="ville">VILLE :</label>
                <input required type="text" class="form-control" id="ville" name="ville" placeholder="Ville">
            </div>
            <div class="col-sm-offset-1 col-sm-2">
                <button type="submit" class="btn btn-success hidden-xs">Enregistrer le nouveau client</button>
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-4">
                <label for="tel">TELEPHONNE :</label>
                <input type="text" class="form-control" id="tel" name="tel" placeholder="N° téléphone">
            </div>
            <div class="form-group col-sm-4">
                <label for="email">EMAIL :</label>
                <input required type="email" class="form-control" id="email" name="email" placeholder="Adresse Email">
            </div>
        </section>
        <section class="row">
            <div class="form-group col-sm-8">
                <label for="note">NOTE :</label>
                <textarea name="note" id="note" class="form-control"  rows="10"></textarea>
            </div>
        </section>
        <div class="col-sm-offset-1 col-sm-2">
            <button type="submit" class="btn btn-success visible-xs">Enregistrer le nouveau client</button>
        </div>
    </form> 
</div>