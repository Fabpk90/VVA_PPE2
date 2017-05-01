<?php
include_once("connectionBDD.php");



function getAllAnim()
{
    global $bdd;

    $query = "SELECT *
              FROM ANIMATION
              WHERE DATEVALIDITEANIM > NOW()";

     $res = $bdd->prepare($query);
     $res->execute();

     return $res->fetchAll();
}

function getNbPlacesLibres($animCode)
{
    global $bdd;

    $query = "SELECT COUNT(*) AS NBINSCRIPTION
                FROM INSCRIPTION
                WHERE CODEANIM = '".$animCode."' AND DATE_ANNULATION IS NULL ";

    $res = $bdd->prepare($query);
    $res->execute();

    $nbInscription = $res->fetch()['NBINSCRIPTION'];

    $res->closeCursor();

    $query = "SELECT (NBREPLACEANIM) AS NBPLACES FROM ANIMATION AS A
                    WHERE A.CODEANIM = '".$animCode."'  ";

   $res1 = $bdd->prepare($query);
   $res1->execute();

   return $res1->fetch()['NBPLACES'] - $nbInscription ;
}


?>
