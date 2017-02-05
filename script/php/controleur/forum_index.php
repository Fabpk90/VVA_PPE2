<?php
include('../modele/forum_index.php');

//if the user exists show the topics
//and if param show the topic's posts
//if not show the form

if (isset($_SESSION['USER']))
{

  header('Location: forum_topics.php');

/*
  else{
    echo '<div class="text-center">';
    $posts = getPosts($_GET['topic']);

    foreach ($posts as $post)
    {
      echo "<p>".$post['USER']."</p>";
      echo "<p>".$post['DTPOST']."</p>";
      echo "<p>".$post['LIBPOST']."</p> <br/>";
    }
    //create the posts form
    ?>
    <form action="forum_index.php?topic=<?php echo $_GET['topic']; ?>" method="post">
      Votre réponse<br/>
      <textarea name="post_rep" form="forum" rows="10" cols="50" style="width: 100%;" required></textarea>
      <br/>
      <button type="submit"> Envoyer votre réponse</button>
    </form>
  </div>

  <?php
}*/

}
else if(isset($_POST['USER']) && isset($_POST['MDP']))
{
    $req = userExists($_POST['USER'], $_POST['MDP']);

    //l'utilisateur éxiste
    if($req)
    {
      echo "Tu existe!";

      $isEncadrant = getEncadrant($_POST['USER']);

      $_SESSION['USER'] = $_POST['USER'];

      $profil = getProfil($_SESSION['USER']);

      $_SESSION['TYPEPROFIL'] = $profil['TYPEPROFIL'];
      $_SESSION['AUTHNEWS'] = $profil['AUTORISATIONNEWS'];

      if($isEncadrant != null)
      {
        echo " encadrant";
      }
      else
      {
        echo " loisant";
      }



    }
    else
    {
      echo "t'es qui?";
    }
}
else {
  ?>

  <form action="forum_index.php" method="POST">

    Nom: <input type="text" name="USER"></input> <br/>
    Mot de passe: <input type="text" name="MDP"></input> <br/>

    <button type="submit">Se connecter</button>

  </form>

  <?php
}

?>
