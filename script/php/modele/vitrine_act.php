<?php
include_once("connectionBDD.php");

function getAllAct($codeAnim)
{
    global $bdd;

    $query = "SELECT *
              FROM ACTIVITE
          WHERE DATEACT > NOW() AND CODEANIM = '".$codeAnim."' AND DATEANNULATIONACT IS NULL";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetchAll();
}

function getEtatAct($code)
{
    global $bdd;

    $query = "SELECT *
              FROM ETAT_ACT
              WHERE CODEETATACT = '".$code."'";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetch();
}

?>
