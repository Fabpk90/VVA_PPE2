<?php

  include_once("connectionBDD.php");

//TO DO: les topic fermer ne pas afficher -> req à modifier
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

//on cherche si le profil est autorisé à voir le topic, si oui true sinon false
function isTopicAccessible($idTopic, $typeProfil)
{
  global $bdd;

  $query = "SELECT *
            FROM AUTORISATION
            WHERE TYPEPROFIL='".$typeProfil."' AND IDTOPIC = ".$idTopic;

   $res = $bdd->prepare($query);
   $res->execute();
  //$res->fetch();

   $res = $res->fetch();

   //si le profil n'est pas autorisé à accéder à ce topic -> false
   return $res != null ? true : false;
}

function addPost($idTopic, $libPost, $user)
{
  global $bdd;

  $queryCount = "SELECT COUNT(NOPOST) AS NBPOST
                 FROM POST
                 WHERE IDTOPIC = ".$idTopic;

  $nbPost = $bdd->prepare($queryCount);
  $nbPost->execute();
  $nbPost = $nbPost->fetch()['NBPOST'];


  $query = "INSERT INTO `act_vva_ppe2`.`post` (`IDTOPIC`, `NOPOST`, `USER`, `DTPOST`, `LIBPOST`)
  VALUES ('".$idTopic."', '".$nbPost."', '".$user."', NOW(), '".$libPost."');";

   $res = $bdd->prepare($query);
   $res->execute();

   return $res == null ? false : true;
}

function addTopic($topicName, $topicDesc, $user)
{
  global $bdd;

  $query = "INSERT INTO `act_vva_ppe2`.`topic` (`USER`, `TITRETOPIC`, `DESCTOPIC`, `DTCREATIONTOPIC`, `DTFERMETURE`)
  VALUES ('".$user."', '".$topicName."', '".$topicDesc."', NOW(), NULL);";

  $res = $bdd->prepare($query);
  $res->execute();

  return $res == null ? false : true;
}

?>
