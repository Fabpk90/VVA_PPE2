<?php

    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=act_vva_ppe2;charset=utf8', 'root', '');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
 ?>
