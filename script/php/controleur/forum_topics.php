<?php

include('../modele/forum_topics.php');

echo '<div class="container-fluid">';
//afficher les topics
if(!isset($_GET['topic']))
{

  echo '<div class="text-center">';
  $topics = getTopics();

  foreach ($topics as $topic) {
    echo '<div class="article">';
      echo '<h3 ><a href="forum_topics.php?topic='.$topic['IDTOPIC'].'" >'.$topic['TITRETOPIC']." </a>";

      if(!isTopicOpen($topic['IDTOPIC']))
      {
        echo "[fermé]";
      }

      echo "</h3>";

      echo "<h4>".$topic['DESCTOPIC']."</h4>";
      echo '<p class="glyphicon glyphicon-time">'.$topic['DTCREATIONTOPIC']."</p>";
      echo '<p><span class="glyphicon glyphicon-user">'.$topic['USER']."</p> </span> <br/>";

    echo '</div>';
  }

  echo "</div>";

}
else if(isset($_GET['delete']))
{
  //supprimer ?
  if($_GET['delete'] == 1)
  {
    deleteTopic($_GET['topic']);
    echo "Topic supprimé!";
  }

  else
  {
    closeTopic($_GET['topic']);
    echo "Topic fermé!";
  }

}
else
{
    //contrôle si l'utilisateur peut voir le sujet
    if(isTopicAccessible($_GET['topic'], $_SESSION['TYPEPROFIL']) || $_SESSION['TYPEPROFIL'] == "EN")
    {
        //si l'utilisateur a répondu, on inscrit sa rép et après on affiche le tout
        if(isset($_POST['post_rep']))
        {
          addPost($_GET['topic'], $_POST['post_rep'], $_SESSION['USER']);
        }

        echo '<div class="text-center">';

        //si l'utilisateur est le créteur, il peut le supprimer ou encadrant
        if(isUserAuthor($_SESSION['USER'], $_GET['topic']) || $_SESSION['USER'] == 'EN')
        {
          echo '<a href="forum_topics.php?topic='.$_GET['topic'].'&delete=1"> Supprimer le topic</a>';
          if(isTopicOpen($_GET['topic']))
            echo '<a href="forum_topics.php?topic='.$_GET['topic'].'&delete=2"> Fermer le topic</a>';
        }


        $posts = getPosts($_GET['topic']);

        foreach ($posts as $post)
        {
          echo '<div class="row"';
            echo "<p>".$post['USER']."</p>";
            echo "<p>".$post['DTPOST']."</p>";
            echo "<p>".$post['LIBPOST']."</p> <br/>";
          echo '</div>';
        }
        //create the posts form if the topic is open
        if(isTopicOpen($_GET['topic']))
        {
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

    }
    else {
      echo "Vous n'avez pas l'autorisation de voir ce topic!";
    }

  }

//container
echo "</div>";

?>
