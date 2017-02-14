<?php
  include('../../../header.php');
  include('../controleur/news_index.php');


//global $message;
//echo $message;

?>
<div class="text-center">
<?php
if(isset($news))
{
  foreach($news as $new)
  {
    echo '<article>';
      echo '<p>Titre: '.$new['titre'].'</p>';
      if($_SESSION['TYPEPROFIL'] == "EN" || isUserAuthorNews($_SESSION['USER'], $new['IDNEWS']) )
      {
          echo '<a href="news_index.php?idnews='.$new['IDNEWS'].'&delete=1" > Supprimer la news </a>';
          echo '<a href="news_modify.php?idnews='.$new['IDNEWS'].'" > Modifier la news </a>';
      }


      echo '<p>Ecrit le: '.$new['date'].'</p>';
       echo '<p>Par: '.$new['NOMPROFIL'].' '.$new['PRENOMPROFIL'].'</p>';
      echo $new['contenu'].'<br/>';
      if(isset($new['comm']))
        echo $new['comm'];
    echo '</article> <br/>';
  }
  if(isset($commentForm))
    echo $commentForm;
?>

</div>

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
