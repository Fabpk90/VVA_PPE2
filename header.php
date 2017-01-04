<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Site communautaire</title>
    <link href="../../css/bootstrap.css" rel="stylesheet">
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
  </head>

<nav class="navbar navbar-default">
  <div class="container-fluid">

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="news.php">News </a></li>
        <li><a href="forum.php">Forum</a></li>
        <?php
        if(isset($_SESSION['USER']))
          echo '<p class="navbar-text navbar-right"> Bienvenue! '.$_SESSION['USER'].' </p>';
        ?>
      </ul>



    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
