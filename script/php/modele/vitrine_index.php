<?php

/*
    toutes les pages sont dans la bdd,
*/



include_once("connectionBDD.php");

function getAllPages()
{
    global $bdd;

    $query = "SELECT *
              FROM PAGE
             ";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetchAll();
}

function getPage($idPage)
{
    global $bdd;

    $query = "SELECT *
              FROM PAGE AS P, PROFIL AS PR
              WHERE P.IDPAGE = '".$idPage."' AND P.AUTEURPAGE = PR.USER";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch();
}



?>
