
<?php
// condition d'affichage du lien vers la page admin
	$admin = '';
    if($_SESSION['uti_autorisation'] === "1"){
        $admin = 
        '
        <div class="btn-group parametres">
        <button type="button" class="btn btn-success dropdown-toggle  " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Paramètres <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="?p=gestion.php">administration</a></li>
          <li><a href="?p=update_mdp.php">Changer le mot de passe</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="?p=deconnexion">Se déconnecter</a></li>
        </ul>
      </div> ';
    } else {
        $admin = 
        '
        <div class="btn-group parametres">
        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Paramètres <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="?p=update_mdp.php">changer le mot de passe</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="?p=deconnexion">Se déconnecter</a></li>
        </ul>
      </div> ';
    }



?>
<section class="container">
<nav class="navbar navbar-default navbar-static-top" role="navigation">
    <!-- logo renvoyant vers la liste des chantiers -->
    <ul class="col-lg-1  nav navbar-nav">
            <li>  
                <a class="navbar-brand" href="?p=liste_chantier">
                    <img id="logo_navbar" alt="logo SPH" src="./assets/images/logo_sph.png">
                </a>
            </li>

            <!-- bouton pour navbar responsive   -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
    </ul>
    
    <!-- contenu de la navbar -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
             <li class="hover"><a  href="?p=nouveau_client">Ajouter un client</a></li>
             <li>
    <!-- formulaire de recherche pour large device -->
             <form class="navbar-form navbar-default col-lg-3"  method="POST" action="?p=recherche_client">
                <input type="text" class="form-control hidden-xs" size="30" placeholder="Rechercher un client par son nom"  id="recherche" name="recherche"/>
                <button type="submit" class="btn btn-success hidden-xs"><i class="glyphicon glyphicon-search"></i></button>
             </form>
    <!-- formulaire de recherche pour small device -->
             <form class="navbar-form navbar-right"  method="POST" action="?p=recherche_client">

                <div class="visible-xs col-xs-8">
                    <input type="text" class="form-control" placeholder="Rechercher un client par son nom"  id="recherche" name="recherche"/>
                </div>
                <button type="submit" class="btn btn-success visible-xs"><i class="glyphicon glyphicon-search"></i></button>
             </form>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right list-inline">
            <!-- <li><a id="hoverDeco" href="?p=deconnexion">Se déconnecter</a></li> -->
            <li><?= $admin ?></li>
            
        </ul>

    <!-- fin du navbar-collapse -->
   
</nav>
</section>




