<?php
include_once("connectionBDD.php");

$limiteContenu = 100;

//renvoie toutes les news, en affichant les premiers 100 caractères
//ou complètement, si $newsEnd = MAX, mais dans rayon de news ex: de la première à la 5ième
function get_news($newsOffset, $newsEnd)
{
  global $bdd;
  global $limiteContenu;

  if($newsOffset != 'MAX')
  {
      $req = $bdd->prepare('SELECT IDNEWS, DTNEWS, LIBNEWS, TITRENEWS, P.NOMPROFIL, P.PRENOMPROFIL FROM NEWS AS N, PROFIL AS P
          WHERE N.USER = P.USER
          LIMIT '.$newsOffset.', '.$newsEnd);

      $req->execute();

      print_r($req);

      $news = $req->fetchAll();
  }
  else
  {
      $req = $bdd->prepare('SELECT P.NOMPROFIL, P.PRENOMPROFIL ,IDNEWS, DTNEWS, TITRENEWS, SUBSTRING(LIBNEWS, 1, '.$limiteContenu.') AS LIBNEWS
      FROM NEWS AS N,PROFIL AS P
       WHERE N.USER = P.USER');
      $req->execute();

      $news = $req->fetchAll();
  }

  return $news;
}

function delete_news($news_id)
{
  global $bdd;

  //supprime les commentaires et après la news
 // $req = $bdd->prepare("DELETE FROM COMMENTAIRE WHERE COMM_NEWS_ID=".$news_id);

  $req = $bdd->prepare("DELETE FROM NEWS WHERE IDNEWS=".$news_id);

  $req->execute();

  return $req == null ? false : true;
}


//renvoie une news complète
function get_single_news($newsID)
{
  global $bdd;

  $req = $bdd->prepare('SELECT DTNEWS, LIBNEWS, TITRENEWS FROM NEWS WHERE IDNEWS ='.$newsID);

  $req->execute();
  $news = $req->fetch();

  return $news;
}

function get_comm_news($newsID)
{
  global $bdd;

  $req = $bdd->prepare('SELECT * FROM NEWS,COMMENTAIRE,USER WHERE NEWS_ID ='.$newsID.' AND NEWS_ID = COMM_NEWS_ID AND USER_ID = COMM_AUTEUR');

  $req->execute();
  $comm = $req->fetchAll();

  return $comm;
}

function isUserAuthorNews($userID, $newsID)
{
    global $bdd;

    $req = $bdd->prepare("SELECT TITRENEWS
                            FROM NEWS
                            WHERE USER = '".$userID."' AND IDNEWS = '".$newsID."'");

    $req->execute();
    $news = $req->fetch();

    return $news == null ? false : true;
}
