<?php
  session_start();

include_once("script/php/modele/vitrine_index.php");

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Site communautaire</title>
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../../js/bbparser/minified/themes/default.min.css" />
    <script src="../../js/bbparser/minified/jquery.sceditor.bbcode.min.js"></script>
    <script src="../../js/bbparser/languages/fr.js"></script>
  </head>

  <script>
$(function() {
    // Replace all textarea tags with SCEditor
    $('textarea').sceditor({
        plugins: 'xhtml',
        style: '../../js/bbparser/minified/jquery.sceditor.default.min.css',
        locale: 'fr'
    });
});
</script>

<nav class="navbar navbar-default">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="navbar-text" ><a href="news_index.php">News </a></li>
        <li class="navbar-text"><a href="forum_index.php">Forum</a></li>
        <li class="navbar-text"><a href="vitrine_anim.php">Consulter les animations</a></li>
        <?php
        if(isset($_SESSION['USER']))
        {
          echo '<div class="navbar-text navbar-right">';
            echo '<h4 class="navbar-text"> Bienvenue '.$_SESSION['USER'].'! </h4>';

            if(isset($_SESSION['AUTHNEWS']) && $_SESSION['AUTHNEWS'])
            {
              echo '<p class="navbar-text"><a href="news_create.php"> Créer une News</a> </p>';
              echo '<p class="navbar-text"><a href="vitrine_index.php"> Gestion des pages</a> </p>';
            }

            echo '<p class="navbar-text"><a href="forum_create.php"> Créer un Topic</a> </p>';
            echo '<p class="navbar-text"><a href="deconnexion.php"> Déconnexion</a> </p>';
          echo '</div>';
        }

        //populating the list of pages

        $pages = getAllPages();

        foreach ($pages as $page) {
            echo '<li class="navbar-text"><a href="vitrine_index.php?page='.$page['IDPAGE'].'">'.$page['NOMPAGE'].'</a></li>';
        }

        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
