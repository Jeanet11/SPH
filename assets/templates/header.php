<nav class="navbar navbar-default">
  <div class="container-fluid">
      
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		<!-- logo cliquable -->
		<ul class="nav navbar-nav">
			<li>  <a class="navbar-brand" href="?=liste_clients">
				<img id="logo_navbar" alt="logo SPH" src="./assets/images/logo_sph.png">
			</a></li>
		</ul>
		<!-- redirection vers la page d'ajout d'un client -->
		<form method="GET" action="?p=creation_client" class="navbar-form navbar-left">
			<button type="button" class="btn btn-success  ">Ajouter un client</button>
		</form>

		<!-- redirection vers la page de déconnexion -->
		<form method="GET" action="?p=deconnexion" class="navbar-form navbar-right">
			<button type="button" class="btn btn-success  ">Se déconnecter</button>
		</form>

		<!-- moteur de recherche par nom -->
      <form class="navbar-form navbar-right">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Rechercher par nom" size="50">
        </div>
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i></button>
      </form>

	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>