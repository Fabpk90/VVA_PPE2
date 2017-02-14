<?php
include('../modele/news_index.php');

//suppression/édition d'une news?
if(isset($_GET['delete']))
{
    if(isUserAuthorNews($_SESSION['USER'], $_GET['delete']) )
    {
        if($_GET['delete'] == 1)
        {
            delete_news($_GET['idnews']);
        }
    }

}



$news = get_news('MAX', 0);

foreach ($news as $key => $new)
{
  $news[$key]['titre'] = $new['TITRENEWS'];
  if(strlen($new['LIBNEWS']) == $limiteContenu)
    $news[$key]['contenu'] = $new['LIBNEWS'].'...' . '<a href="script/php/vue/news_index.php?newsID='.$new['IDNEWS'].'"> Lire la suite </a>';
  else
    $news[$key]['contenu'] = $new['LIBNEWS'];
  $news[$key]['date'] = $new['DTNEWS'];
  //$news[$key]['comm'] = '<a onclick="loadPage(' ."'" .'news.php?newsID='.$new['NEWS_ID']. "')". '" href="#"> Comments </a>';
}

/*
//affiche tuote les news si aucun parmètre es donné,
//si donné affiche la news en param mais en entier
if(isset($_POST['news_id']) && isset($_POST['comm_desc']))
{
 add_comm($_POST['news_id'], $_SESSION['user_id'], $_POST['comm_desc']);
 $message = 'The comment has been sent <a href="#" onclick="loadPage('. "'". 'news.php?newsID='.$_POST['news_id']."')" . '"> Go back to the news</a>';
}
else if(!isset($_GET['newsID']))
{
  $news = get_news('MAX', 0);

  foreach ($news as $key => $new)
  {
    $news[$key]['titre'] = $new['NEWS_TITRE'];
    if(strlen($new['NEWS_CONTENU']) == $limiteContenu)
      $news[$key]['contenu'] = $new['NEWS_CONTENU'].'...' . '<a onclick="loadPage(' ."'" .'news.php?newsID='.$new['NEWS_ID']. "')". '" href="#"> Lire la suite </a>';
    else
      $news[$key]['contenu'] = $new['NEWS_CONTENU'];
    $news[$key]['date'] = $new['NEWS_DATE'];
    $news[$key]['comm'] = '<a onclick="loadPage(' ."'" .'news.php?newsID='.$new['NEWS_ID']. "')". '" href="#"> Comments </a>';
  }
}
else if(isset($_GET['comm_id']))
{
   delete_comm($_GET['comm_id']);
   $message = 'The comment has been delete <a href="#" onclick="loadPage('. "'". 'news.php?newsID='.$_GET['newsID']."')" . '"> Go back to the news</a>';
}
else
{
    $new = get_single_news($_GET['newsID']);

    $news[0]['titre'] = $new['NEWS_TITRE'];
    $news[0]['contenu'] = $new['NEWS_CONTENU'];
    $news[0]['date'] = $new['NEWS_DATE'];

    $formSubmitPage = " 'news.php' ";

    if(isset($_SESSION['user_id']))
    {

      $paramName = " 'news_id' ";
      $paramValue = $_GET['newsID'];

      $commentForm = '<script>
                    // attache un comportement au submit
                    $( "#formCommentAdd" ).submit(function( event ) {

                      // empêche le form de submit normalement(charge pas de page directement)
                      event.preventDefault();

                      submitFormAndLoadPage(this,'.$formSubmitPage.', '.$paramName.', '.$paramValue.');
                    });

                  </script>';


      $commentForm = $commentForm.'
                  <form action="#" method="POST" id="formCommentAdd">
                      Write your comment down below<br/><textarea name="comm_desc" form="formCommentAdd" rows="10" cols="50" required></textarea> <br/>
                      <button  > Send your comment </button>
                   </form>';
    }

    $comm = get_comm_news($_GET['newsID']);

    //si il y a des commentaires ont les met dans la matrice qui sera affichée
    if(isset($comm))
    {
      $commentaires = "";
      foreach ($comm as $commentaire)
      {
        $commentaires = $commentaires."<article>";
          $commentaires = $commentaires."Author: ".$commentaire['USER_PSEUDO'];
          $commentaires = $commentaires."<br/>".$commentaire['COMM_TEXTE'];
          $commentaires = $commentaires.'<br/><a href="#" onclick="loadPage(' ."'" .'news.php?comm_id='.$commentaire['COMM_ID']. "&newsID=".$_GET['newsID']."')".'" >Delete the comment </a>';
        $commentaires = $commentaires."</article>";
      }
    }

}

//libére la connexion à la bdd
global $bdd;

$bdd = null;
*/
