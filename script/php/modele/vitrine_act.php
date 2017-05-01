<?php
include_once("connectionBDD.php");

function getAct($codeAnim)
{
    global $bdd;

    $query = "SELECT *
              FROM ACTIVITE
              WHERE CODEANIM = '".$codeAnim."' AND DATEANNULATIONACT IS NULL";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetchAll();
}

?>
