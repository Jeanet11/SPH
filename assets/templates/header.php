<nav class="navbar navbar-default ">
  <div class="container-fluid">
  
  	<ul class="col-md-12 col-lg-1 nav navbar-nav">
  		<li>  
  			<a class="navbar-brand" href="?p=liste_chantier">
  				<img id="logo_navbar" alt="logo SPH" src="./assets/images/logo_sph.png">
  			</a>
  		</li>
  	</ul>
	      
    <div class="row collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<!-- logo cliquable -->
		
		<!-- redirection vers la page d'ajout d'un client -->
		<form method="GET" class="navbar-form navbar-left col-md-12 col-lg-4">
			<a href="?p=nouveau_client"><button type="button" class="btn btn-success  ">Ajouter un client</button></a>
		</form>

		<!-- redirection vers la page de déconnexion -->
		<form method="GET" class="navbar-form navbar-right col-md-12 col-lg-3">
			<a href="?p=deconnexion"><button type="button" class="btn btn-success  ">Se déconnecter</button></a>
		</form>

		<!-- moteur de recherche par nom -->
      <form class="navbar-form navbar-right col-md-12 col-lg-5 visible-lg">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher par nom" size="50">
        </div>
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
      </form>
	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>