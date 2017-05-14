<?php
include('../modele/forum_index.php');

//if the user exists show the topics
//and if param show the topic's posts
//if not show the form

if (isset($_SESSION['USER']))
{

  header('Location: forum_topics.php');

}
else if(isset($_POST['USER']) && isset($_POST['MDP']))
{
    $req = userExists($_POST['USER'], $_POST['MDP']);

    //l'utilisateur éxiste
    if($req)
    {
      $_SESSION['USER'] = $_POST['USER'];

      $profil = getProfil($_SESSION['USER']);

      $_SESSION['TYPEPROFIL'] = $profil['TYPEPROFIL'];
      $_SESSION['AUTHNEWS'] = $profil['AUTORISATIONNEWS'];

      header('Location: forum_index.php');
    }
    else
    {
        echo '<div class="alert alert-warning col-md-3  ">';
            echo "Les infomations ne sont pas correctes!";
        echo "</div>";
    }
}
else {
  ?>
  <div class="text-center">
      <div class="form-group">
          <form action="forum_index.php" method="POST">

            Nom: <input type="text" name="USER"></input> <br/>
            Mot de passe: <input type="password" name="MDP"></input> <br/>

            <button class="btn btn-primary" type="submit">Se connecter</button>

          </form>
      </div>
  </div>

  <?php
}

?>
