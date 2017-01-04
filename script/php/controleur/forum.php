<?php
include('../modele/forum.php');

if (isset($_SESSION['USER'])) {

  if(!isset($_GET['topic']))
  {
    //afficher les topics

    echo '<div class="text-center">';
    $topics = getTopics();

    foreach ($topics as $topic) {
      echo '<p><a href="forum.php?topic='.$topic['IDTOPIC'].'" >'.$topic['TITRETOPIC']." </a> </p>";
      echo "<p>".$topic['DESCTOPIC']."</p>";
      echo "<p>".$topic['DTCREATIONTOPIC']."</p>";
      echo "<p>".$topic['USER']."</p> <br/>";
    }
    echo "</div>";
  }
  else{
    echo '<div class="text-center">';
    $posts = getPost($_GET['topic']);

    foreach ($posts as $post)
    {
      echo "<p>".$post['USER']."</p>";
      echo "<p>".$post['DTPOST']."</p>";
      echo "<p>".$post['LIBPOST']."</p> <br/>";
    }
    echo "</div>";
  }

}
else if(isset($_POST['USER']) && isset($_POST['MDP']))
{
    $req = userExists($_POST['USER'], $_POST['MDP']);

    if($req)
    {
      echo "Tu existe!";

      $isEncadrant = getEncadrant($_POST['USER']);

      if($isEncadrant != null)
      {
        echo " encadrant";
      }
      else
      {
        echo " loisant";
      }

      $_SESSION['USER'] = $_POST['USER'];
    }
    else
    {
      echo "t'es qui?";
    }
}
else {
  ?>

  <form action="forum.php" method="POST">

    Nom: <input type="text" name="USER"></input> <br/>
    Mot de passe: <input type="text" name="MDP"></input> <br/>

    <button type="submit">Se connecter</button>

  </form>

  <?php
}

?>
