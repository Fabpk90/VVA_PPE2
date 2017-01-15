<?php

include('../modele/forum_topics.php');

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
  <form action="forum_topics.php?topic=<?php echo $_GET['topic']; ?>" method="post">
    Votre réponse<br/>
    <textarea name="post_rep" form="forum" rows="10" cols="50" style="width: 100%;" required></textarea>
    <br/>
    <button type="submit"> Envoyer votre réponse</button>
  </form>
</div>
<?php
}

?>
