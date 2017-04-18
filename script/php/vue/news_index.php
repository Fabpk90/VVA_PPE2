<?php
  include('../../../header.php');
  include('../controleur/news_index.php');


//global $message;
//echo $message;

?>
<div class="container-fluid">

    <div class="text-center">
    <?php
    if(isset($news))
    {
      foreach($news as $new)
      {
        echo '<div class="panel panel-primary">';
            echo '<div class="panel-heading">';
                  echo '<h3>'.$new['titre'].'</h3>';
            echo '</div>';
                if(isset($_SESSION['TYPEPROFIL']))
                {
                    if($_SESSION['TYPEPROFIL'] == "EN" || isUserAuthorNews($_SESSION['USER'], $new['IDNEWS']) )
                    {
                        echo '<a class="btn btn-danger" href="news_index.php?idnews='.$new['IDNEWS'].'&delete=1" > Supprimer la news </a>';
                        echo '<a class="btn btn-warning" href="news_modify.php?idnews='.$new['IDNEWS'].'" > Modifier la news </a>';
                    }
                }
                  echo '<p>Par: '.$new['NOMPROFIL'].' '.$new['PRENOMPROFIL'].'  le: '.$new['date'].'</p>';


          echo $new['contenu'].'<br/>';
          if(isset($new['comm']))
            echo $new['comm'];
        echo '</div> <br/>';
      }
      if(isset($commentForm))
        echo $commentForm;
    ?>

    </div>
</div><!-- container -->
<?php
/*  global $commentaires;
  //affiche les commentaires si présents
  if(isset($commentaires))
  {
    echo $commentaires;
  }
  else if(isset($_GET['newsID']))
  {
    echo '<p>No Comments here..</p>';
  }*/
}
else {//pas de news
  echo "salut";
}



?>
