<?php
  include_once('../modele/forum_create.php');


  if(isset($_POST['TITRE']))
  {
    //create the topic
    addTopic($_POST['TITRE'], $_POST['DESC'], $_SESSION['USER']);
    addPost(getLastTopic(), $_POST['TOPIC_CONT'], $_SESSION['USER']);

    //post créé, redirection vers l'index
    header('Location: forum_index.php');
  }
  else
  {  //post non créé, donc création du formulaire
    ?>
    <div class="text-center">
        <div class="form-group">
          <form id="forum" action="forum_create.php" method="post">
            Titre du topic: <br/>
            <input  type="text"  name="TITRE" required><br/>
            Description du topic: <br/>
            <input  type="text" name="DESC" required> <br/>
              Contenu du topic:<br/>
            <textarea name="TOPIC_CONT" form="forum" rows="10" cols="50" style="width: 100%;" required></textarea> <br/>
            <button type="submit" class="btn btn-default"> Créer un Topic</button>
          </form>
        </div>
    </div>


    <?php
  }

 ?>
