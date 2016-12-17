<?php
  include('../php/utils.php');
  include_once('../php/connection_bdd.php');
  include('controleur/news.php');

  createHeaderPage("the news");


global $message;

echo $message;

if(isset($news))
{
  foreach($news as $new)
  {
    echo '<article>';
      echo '<p>Title of the news: '.$new['titre'].'</p>';
      echo '<p>Wrote the: '.$new['date'].'</p>';
      echo $new['contenu'].'<br/>';
      if(isset($new['comm']))
        echo $new['comm'];
    echo '</article> <br/>';
  }
  if(isset($commentForm))
    echo $commentForm;

  global $commentaires;
  //affiche les commentaires si présents
  if(isset($commentaires))
  {
    echo $commentaires;
  }
  else if(isset($_GET['newsID']))
  {
    echo '<p>No Comments here..</p>';
  }
}



?>
