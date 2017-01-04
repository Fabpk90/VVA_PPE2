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
      $req = $bdd->prepare('SELECT IDNEWS, DTNEWS, LIBNEWS, TITRENEWS FROM NEWS LIMIT '.$newsOffset.', '.$newsEnd);

      $req->execute();

      print_r($req);

      $news = $req->fetchAll();
  }
  else
  {
      $req = $bdd->prepare('SELECT IDNEWS, DTNEWS, TITRENEWS, SUBSTRING(LIBNEWS, 1, '.$limiteContenu.') AS LIBNEWS FROM NEWS');
      $req->execute();

      $news = $req->fetchAll();
  }

  return $news;
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

function update_news($newsID, $news_titre, $news_date, $news_contenu)
{
  global $bdd;

  $req = $bdd->prepare("UPDATE NEWS
                        SET NEWS_TITRE = '".$news_titre."', NEWS_DATE = '".$news_date."', NEWS_CONTENU = '".$news_contenu."'
                        WHERE NEWS_ID =".$newsID);

  $req->execute();

  return $req == null ? false : true;
}

function add_comm($newsID, $user_id, $comm_texte)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO COMMENTAIRE(COMM_NEWS_ID, COMM_AUTEUR, COMM_TEXTE, COMM_DATE)
                        VALUES('".$newsID."', '".$user_id."', '".htmlspecialchars($comm_texte)."', NOW())");

  $req->execute();


  return $req == null ? false : true;
}

function add_news($news_titre, $news_date, $news_contenu)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO NEWS(NEWS_TITRE, NEWS_DATE, NEWS_CONTENU, NEWS_AUTEUR)
                        VALUES('".$news_titre."', '".$news_date."', '".$news_contenu."', ".$_SESSION['user_id'].")");

  $req->execute();

  return $req == null ? false : true;
}

function delete_news($news_id)
{
  global $bdd;

  //supprime les commentaires et après la news
  $req = $bdd->prepare("DELETE FROM COMMENTAIRE WHERE COMM_NEWS_ID=".$news_id);

  $req = $bdd->prepare("DELETE FROM NEWS WHERE NEWS_ID=".$news_id);

  $req->execute();

  return $req == null ? false : true;
}

function delete_comm($comm_id)
{
  global $bdd;
  //supprime les commentaires et après la news
  $req = $bdd->prepare("DELETE FROM COMMENTAIRE WHERE COMM_ID=".$comm_id);

  $req->execute();

  return $req == null ? false : true;
}
