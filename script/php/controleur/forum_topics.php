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
      echo '<h2>';
      if(!isTopicOpen($topic['IDTOPIC']))
      {
        echo '<a class="btn-warning btn-lg" href="forum_topics.php?topic='.$topic['IDTOPIC'].'" >'.$topic['TITRETOPIC']." </a>";
        echo "[fermé]";
      }
      else {
          echo '<a class="btn-primary btn-lg" href="forum_topics.php?topic='.$topic['IDTOPIC'].'" >'.$topic['TITRETOPIC']." </a>";
      }




      echo "</h2>";

      echo "<h3>".$topic['DESCTOPIC']."</h3>";
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

        //10 post par page
        //getTopicNbPage($_GET['topic'], 10);

        echo '<div>';

        //si l'utilisateur est le créteur, il peut le supprimer ou encadrant
        if(isUserAuthor($_SESSION['USER'], $_GET['topic']) || $_SESSION['USER'] == 'EN')
        {
          echo '<a class="btn btn-danger lg" href="forum_topics.php?topic='.$_GET['topic'].'&delete=1"> Supprimer le topic</a>';
          if(isTopicOpen($_GET['topic']))
            echo '<a class="btn btn-default lg" href="forum_topics.php?topic='.$_GET['topic'].'&delete=2"> Fermer le topic</a>';
        }

        $posts = getPosts($_GET['topic']);

        foreach ($posts as $post)
        {
            echo '<div class="panel panel-default">';
              echo '<div class="row offset1 panel-heading">';
                echo '<h4 class="btn btn-primary">Auteur: '.$post['USER']."</h4>";
                echo "<p>Le: ".$post['DTPOST']."</p>";
                echo '<p class="panel-body">'.$post['LIBPOST']."</p> <br/>";
              echo '</div>';
            echo "</div>";
        }
        //create the posts form if the topic is open
        if(isTopicOpen($_GET['topic']))
        {
            ?>
            <div class="form-group text-center">

              <textarea name="post_rep" form="forum" rows="10" cols="50" style="width: 100%;" class="form-control" required></textarea>
              <form id="forum" action="forum_topics.php?topic=<?php echo $_GET['topic']; ?>" method="post">
                <br/>
                <button type="submit" class="btn btn-primary"> Envoyer votre réponse</button>
              </form>
            </div>
          </div>
          <?php
        }
        else {
            echo "Le topic est fermé, aucun post ne peut être ajouté.";
        }

    }
    else {
      echo "Vous n'avez pas l'autorisation de voir ce topic!";
    }

  }

//container
echo "</div>";

include_once("../../../footer.php");

?>
