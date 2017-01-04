<?php
  include_once("connectionBDD.php");

  //check si l'utilisateru existe

  function userExists($user, $mdp)
  {
    global $bdd;

    $query = "SELECT *
              FROM PROFIL AS P
              WHERE P.USER = '".$user."' AND P.MDP = '".$mdp."'";

     $res = $bdd->prepare($query);
     $res->execute();

      if($res->fetch() != null)
      {
        return true;
      }
        return false;
  }

  function encadrantExist($user)
  {
    global $bdd;

    $query = "SELECT NOENCADRANT
              FROM ENCADRANT AS E
              WHERE E.USER = '".$user."'";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch();
  }

  function getEncadrant($user)
  {
    global $bdd;

    $query = "SELECT *
              FROM ENCADRANT AS E
              WHERE E.USER = '".$user."'";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch();
  }

  function getTopics()
  {
    global $bdd;

    $query = "SELECT *
              FROM TOPIC AS T";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetchALL();
  }

  function getPost($idTopic)
  {
    global $bdd;

    $query = "SELECT T.USER, DTPOST, LIBPOST
              FROM TOPIC AS T, POST AS P
              WHERE T.IDTOPIC = '".$idTopic."' AND T.IDTOPIC = P.IDTOPIC";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetchALL();
  }
?>
