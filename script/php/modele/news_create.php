<?php

include_once("connectionBDD.php");


function add_comm($newsID, $user_id, $comm_texte)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO COMMENTAIRE(COMM_NEWS_ID, COMM_AUTEUR, COMM_TEXTE, COMM_DATE)
                        VALUES('".$newsID."', '".$user_id."', '".htmlspecialchars($comm_texte)."', NOW())");

  $req->execute();


  return $req == null ? false : true;
}

function add_news($news_titre, $news_date, $news_contenu, $userID)
{
  global $bdd;

  $req = $bdd->prepare("INSERT INTO `act_vva_ppe2`.`news` (`TITRENEWS`,`DTNEWS`, `LIBNEWS`, `USER`)
  VALUES('".$news_titre."', '".$news_date."', '".$news_contenu."', '".$userID."')");

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

?>
