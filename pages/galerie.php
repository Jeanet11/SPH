<?php
//verifie l'identification
if (empty($_SESSION['uti_pseudo'])){
  header("Location: ?p=connexion");
};
function verif_repertoire($repertoire)
{
  $nbFichiers = 0;
  if (is_dir($repertoire))
    {
    if ($dh = opendir($repertoire))
      {
      while ($fichier = readdir($dh))
        {
        $nbFichiers += 1;
      }
      closedir($dh);
    }
  }
  else {
    //echo ("Le répertoire n'existe pas");
    return -1;
  };
  if ($nbFichiers == 2) {
    //echo ("Le répertoire existe mais il est vide");
    return 0;
  }
  else {
    //echo ("Le répertoire contient des fichiers : " . ($nbFichiers - 2));
    return $nbFichiers-2;
  };
};

function upload_photo($id, $num){
  echo '<section class="container">
  <a class="btn btn-success" href="?p=fiche_chantier&id='.$id.'"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> CHANTIER</span></a>  
  <form method="post" action="?p=up_photo" enctype="multipart/form-data">
  <ul class="list-inline">
  <input type="hidden" name="num" value="'.$num.'" />
  <input type="hidden" name="id" value="'.$id.'" />
  <li class=" col-sm-offset-3 col-sm-2 col-xs-12 text-uppercase">Ajouter une photo :</li>
  <li class=""><input type="file" name="'.$num.'" /></li>
  <li class=""><input type="submit" name="submit" value="Enregistrer" /></li>
  </ul></form></section>';
};
$id = $_GET["id"];
$dossier = "./documents/" . $id . "/photo";
$photo = verif_repertoire($dossier);

if ($photo  == -1) {
  mkdir($dossier, 0777, true);
};
if ($photo  <= 0) {
  //si le répertoire existe mais il est vide
  upload_photo($id,(1));
?>
<section class="container text-center">
  <h1>Aucune photo n'est disponible pour ce chantier</h1>
</section>
<?php
}elseif ($photo  >= 1) {
  //si il ya des fichiers
  upload_photo($id,($photo+1));
?>
<section class="container">
  <div class="col-sm-offset-2 col-sm-8">
    <div id="myCarousel" class="carousel slide" data-ride="carousel"  data-interval="false">
      <!-- Indicateur du bas -->
      <ol class="carousel-indicators">
        <?php
        echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
        //PHP créer les li en fonction du nombre de photos
          for ($i=1; $i < $photo; $i++) { 
            echo '<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
          };
        ?>
      </ol>

      <!-- Liste des images pour le slide -->
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?= $dossier ?>/1.jpg" alt="Photo 1">
        </div>
        <?php
        //PHP créer les li en fonction du nombre de photos
          for ($i=2; $i < $photo+1; $i++) { 
            echo '<div class="item">
                  <img src="'.$dossier.'/'.$i.'.jpg" alt="Photo '.$i.'">
                  </div>';
          };
        ?>
      </div>

      <!-- Controle des fleches de gauche et droite -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Précédent</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Suivant</span>
      </a>
    </div>
  </div>
  <!-- FIN CAROUSEL -->
  <!-- Miniatures -->
  <div class="row">
    <div class="col-xs-12 text-center">
    <?php
    //PHP créer les mignature en fonction du nombre de photos
    for ($i=0; $i < $photo; $i++) { 
      echo '
        <a class="" href="#myCarousel" data-slide-to="'.$i.'">
        <img class="mini" src="'.$dossier.'/'.($i+1).'.jpg" alt="Photo '.($i+1).'">        
      </a>';
      };
    ?>
    </div>
  <!-- <a class="thumbnail" href="#myCarousel" data-slide-to="0">
      <img src="./documents/3/photo/1.jpg" alt="...">
    </a> -->
</div>
</section>
<?php
}
?>