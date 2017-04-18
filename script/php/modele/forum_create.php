<?php
  include_once("connectionBDD.php");
  //utilisé pour le addpost
  include_once("../modele/forum_topics.php");

  function addTopic($topicName, $topicDesc, $user, $idTopic)
  {
    global $bdd;

    $query = "INSERT INTO TOPIC(IDTOPIC, USER, TITRETOPIC, DESCTOPIC, DTCREATIONTOPIC, DTFERMETURE)
    VALUES('".$idTopic."', '".$user."', '".$topicName."', '".$topicDesc."', NOW(), NULL);";

    $res = $bdd->prepare($query);
    $res->execute();

    return $res == null ? false : true;
  }

  function addAutoToTopic($idTopic,$typeProfil)
  {

    global $bdd;

    $query = "INSERT INTO `act_vva_ppe2`.`autorisation` (`TYPEPROFIL`, `IDTOPIC`)
    VALUES ('".$typeProfil."', '".$idTopic."');";

    $res = $bdd->prepare($query);
    $res->execute();

    //print_r($res->errorInfo());

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

  //renvoie la liste des profils
  //les profils  sont utilisé pour l'autorisation, c'est pour ça
  function getListTypeProfil()
  {
      global $bdd;

      $query = "SELECT TYPEPROFIL, LIBTYPEPROFIL
                FROM TYPEPROFIL";

       $res = $bdd->prepare($query);
       $res->execute();

       return $res->fetchAll();
  }

 ?>
