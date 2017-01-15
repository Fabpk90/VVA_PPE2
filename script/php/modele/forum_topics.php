<?php

  include_once("connectionBDD.php");

function getTopics()
{
  global $bdd;

  $query = "SELECT *
            FROM TOPIC AS T";

   $res = $bdd->prepare($query);
   $res->execute();

   return $res->fetchAll();
}

function getPosts($idTopic)
{
  global $bdd;

  $query = "SELECT T.USER, DTPOST, LIBPOST
            FROM TOPIC AS T, POST AS P
            WHERE T.IDTOPIC = '".$idTopic."' AND T.IDTOPIC = P.IDTOPIC";

   $res = $bdd->prepare($query);
   $res->execute();

   return $res->fetchAll();
}

function addPost($idTopic, $libPost, $user)
{
  global $bdd;

  $queryCount = "SELECT COUNT(NOPOST) AS NBPOST
                 FROM POST
                 WHERE IDTOPIC = ".$idTopic;

  $nbPost = $bdd->prepare($queryCount);
  $nbPost = $nbPost->execute();
  $nbPost = $nbPost->fetch();

  print_r($nbPost);

  $query = "INSERT INTO `act_vva_ppe2`.`post` (`IDTOPIC`, `NOPOST`, `USER`, `DTPOST`, `LIBPOST`)
  VALUES ('".$idTopic."', '".$nbPost['NBPOST']."', '".$user."', NOW(), '".$libPost."');";

   $res = $bdd->prepare($query);
   $res->execute();

   return $req == null ? false : true;
}

?>
