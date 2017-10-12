<nav class="navbar navbar-default container">
  <div class="">
 <!--  logo dans un ul -->
  	<ul class="col-xs-4  col-lg-1 nav navbar-nav">
  		<li>  
  			<a class="navbar-brand" href="?p=liste_chantier">
  				<img id="logo_navbar" alt="logo SPH" src="./assets/images/logo_sph.png">
  			</a>
  		</li>
  	</ul>


	  <div class=" navbar-default">
    <div class="">    
   <!--  <div class="row collapse navbar-collapse" id="bs-example-navbar-collapse-1"> -->
		<!-- logo cliquable -->
		
		<!-- redirection vers la page d'ajout d'un client -->
  		<form method="GET" class="navbar-form navbar-left   col-xs-3  col-lg-4">
  			<a href="?p=nouveau_client"><button type="button" class="btn btn-success  ">Ajouter un client</button></a>
  		</form>
      </div>
		<!-- redirection vers la page de déconnexion -->
  		<form method="GET" class="navbar-form navbar-right  col-xs-offset-2 col-xs-3  col-lg-3">
  			<a href="?p=deconnexion"><button type="button" class="btn btn-success  ">Se déconnecter</button></a>
  		</form>

		<!-- moteur de recherche par nom -->
      <form class="navbar-form navbar-right row"  method="POST" action="?p=recherche_client">
        <div class="form-group col-xs-10">
          <input type="text" class="form-control " placeholder="Rechercher un client par son nom" size="50" id="nom" name="nom"/>
        </div>
        <button type="submit" class="btn btn-success col-xs-2"><i class="glyphicon glyphicon-search"></i></button>
      </form>
	
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-->
</nav>



