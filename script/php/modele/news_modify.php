<?php

include_once("connectionBDD.php");
include_once("../modele/news_index.php");

function update_news($newsID, $news_titre, $news_date, $news_contenu)
{
  global $bdd;

  $req = $bdd->prepare("UPDATE NEWS
                        SET TITRENEWS = '".$news_titre."', DTNEWS = '".$news_date."', LIBNEWS = '".$news_contenu."'
                        WHERE IDNEWS =".$newsID);

  $req->execute();

  return $req == null ? false : true;
}


?>
