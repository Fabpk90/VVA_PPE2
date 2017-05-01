<?php

include_once("connectionBDD.php");

function addPage($user, $nomPage, $contenuPage)
{
    global $bdd;

    $query = "INSERT INTO PAGE(NOMPAGE, AUTEURPAGE, CONTENUPAGE)
    VALUES('".$nomPage."', '".$user."', '".$contenuPage."');";

    $res = $bdd->prepare($query);
    $res->execute();

    return $res == null ? false : true;
}

function deletePage($idPage)
{
    global $bdd;

    $query = "DELETE FROM PAGE
                WHERE IDPAGE =".$idPage;

    $res = $bdd->prepare($query);
    $res->execute();

    return $res == null ? false : true;
}

function modifyPage($idPage, $user, $nomPage, $contenuPage)
{
    global $bdd;

    $query = "UPDATE PAGE
        SET NOMPAGE = '".$nomPage."', AUTEURPAGE = '".$user."', CONTENUPAGE = '".$contenuPage."'
        WHERE IDPAGE = ".$idPage;

    $res = $bdd->prepare($query);
    $res->execute();

    return $res == null ? false : true;
}

?>
