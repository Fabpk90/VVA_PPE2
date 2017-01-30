<?php
  include_once("connectionBDD.php");
  //utilisé pour le addpost
  include_once("../modele/forum_topics.php");

  function addTopic($topicName, $topicDesc, $user)
  {
    global $bdd;

    $query = "INSERT INTO `act_vva_ppe2`.`topic` (`USER`, `TITRETOPIC`, `DESCTOPIC`, `DTCREATIONTOPIC`, `DTFERMETURE`)
    VALUES ('".$user."', '".$topicName."', '".$topicDesc."', NOW(), NULL);";

    $res = $bdd->prepare($query);
    $res->execute();

    return $res == null ? false : true;
  }

  function getLastTopic()
  {
    global $bdd;

    //prend le dernier id inséré
    $query = "SELECT COUNT(IDTOPIC) AS NBTOPIC
              FROM TOPIC AS T
              ORDER BY IDTOPIC LIMIT 1";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch()['NBTOPIC'];
  }

 ?>
