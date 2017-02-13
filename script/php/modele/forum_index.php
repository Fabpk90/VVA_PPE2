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

  function getLoisant($user)
  {
    global $bdd;

    $query = "SELECT *
              FROM LOISANT AS L
              WHERE L.USER = '".$user."'";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch();
  }

  function getProfil($user)
  {
    global $bdd;

    $query = "SELECT *
              FROM PROFIL AS P, TYPEPROFIL AS T
              WHERE P.USER = '".$user."' AND T.TYPEPROFIL = P.TYPEPROFIL";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch();
  }
?>
