<?php

include('../modele/forum_topics.php');

echo '<div class="container-fluid">';
//afficher les topics
if(!isset($_GET['topic']))
{

  echo '<div class="text-center">';
  $topics = getTopics();

  foreach ($topics as $topic) {
    echo '<p><a href="forum_topics.php?topic='.$topic['IDTOPIC'].'" >'.$topic['TITRETOPIC']." </a> </p>";
    echo "<p>".$topic['DESCTOPIC']."</p>";
    echo "<p>".$topic['DTCREATIONTOPIC']."</p>";
    echo "<p>".$topic['USER']."</p> <br/>";
  }

  echo "</div>";

}
else
{
    //contrôle si l'utilisateur peut voir le sujet
    if(isTopicAccessible($_GET['topic'], $_SESSION['TYPEPROFIL']))
    {
        //si l'utilisateur a répondu, on inscrit sa rép et après on affiche le tout
        if(isset($_POST['post_rep']))
        {
          addPost($_GET['topic'], $_POST['post_rep'], $_SESSION['USER']);
        }

        echo '<div class="text-center">';
        $posts = getPosts($_GET['topic']);

        foreach ($posts as $post)
        {
          echo '<div class="row"';
            echo "<p>".$post['USER']."</p>";
            echo "<p>".$post['DTPOST']."</p>";
            echo "<p>".$post['LIBPOST']."</p> <br/>";
          echo '</div>';
        }
        //create the posts form
        ?>
        <div class="form-group">

          <textarea name="post_rep" form="forum" rows="10" cols="50" style="width: 100%;" class="form-control" required></textarea>
          <form id="forum" action="forum_topics.php?topic=<?php echo $_GET['topic']; ?>" method="post">
            <br/>
            <button type="submit" class="btn btn-default"> Envoyer votre réponse</button>
          </form>
        </div>
      </div>
      <?php
    }
    else {
      echo "Vous n'avez pas l'autorisation de voir ce topic!";
    }

  }

//container
echo "</div>";

?>
