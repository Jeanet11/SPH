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
             <form class="navbar-form navbar-right"  method="POST" action="?p=recherche_client">
                <input type="text" class="form-control hidden-xs" size="50" placeholder="Rechercher un client par son nom"  id="nom" name="nom"/>
                <button type="submit" class="btn btn-success hidden-xs"><i class="glyphicon glyphicon-search"></i></button>
             </form>
    <!-- formulaire de recherche pour small device -->
             <form class="navbar-form navbar-right"  method="POST" action="?p=recherche_client">

                <div class="visible-xs col-xs-8">
                    <input type="text" class="form-control" placeholder="Rechercher un client par son nom"  id="nom" name="nom"/>
                </div>
                <button type="submit" class="btn btn-success visible-xs"><i class="glyphicon glyphicon-search"></i></button>
             </form>
            </li>
        </ul>

        <ul class="nav navbar-nav">
            <li><a id="hoverDeco" href="?p=deconnexion">Se déconnecter</a></li>
        </ul>
    </div>
    <!-- fin du navbar-collapse -->
   
</nav>
</section>




