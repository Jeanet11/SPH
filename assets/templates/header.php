
<nav class="navbar navbar-default container">
  <div class="">

  <button type="button" class="navbar-toggle navbar-toggle-left collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2" data-label-expanded="Close" aria-expanded="false">
    <span class="navbar-toggle-label">Menu</span>
    <span class="sr-only">(toggle)</span>

    <span class="navbar-toggle-icon">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </span>
  </button>
 <!--  logo dans un ul -->
  	<ul class=" col-lg-1  nav navbar-nav">
  		<li>  
  			<a class="navbar-brand" href="?p=liste_clients">
  				<img id="logo_navbar" alt="logo SPH" src="./assets/images/logo_sph.png">
  			</a>
  		</li>
  	</ul>


	  <div class=" navbar-default">
    <div class="">    
   <!--  <div class="row collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
		<!-- logo cliquable -->
		
		<!-- redirection vers la page d'ajout d'un client -->
  		<form method="GET" class="navbar-form navbar-left   hidden-xs col-lg-4">
  			<a href="?p=nouveau_client"><button type="button" class="btn btn-success  ">Ajouter un client</button></a>
  		</form>
      </div>
		<!-- redirection vers la page de déconnexion -->
  		<form method="GET" class="navbar-form navbar-right hidden-xs  col-lg-3">
  			<a href="?p=deconnexion"><button type="button" class="btn btn-success  ">Se déconnecter</button></a>
  		</form>

		<!-- moteur de recherche par nom -->
      <form class="navbar-form navbar-right hidden-xs"  method="POST" action="?p=recherche_client">
        <div class="form-group ">
          <input type="text" class="form-control " placeholder="Rechercher un client par son nom" size="50" id="nom" name="nom"/>
        </div>
        <button type="submit" class="btn btn-success "><i class="glyphicon glyphicon-search"></i></button>
      </form>
	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-->
</nav>



