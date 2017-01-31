<?php
  include_once('../modele/forum_create.php');


  if(isset($_POST['TITRE']))
  {
    //create the topic
    addTopic($_POST['TITRE'], $_POST['DESC'], $_SESSION['USER']);

    $lastTopicID = getLastTopic();

    addAutoToTopic($lastTopicID, $_SESSION['TYPEPROFiL']);
    addPost($lastTopicID, $_POST['TOPIC_CONT'], $_SESSION['USER']);

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


              <?php

              //TO DO: mettre un truc dynamique pour l'auto
              if($_SESSION['TYPEPROFiL'] == "EN")
              {
                echo ' Autorisation nécessaire pour voir le topic: <br/>';
                echo '  <select name="type_auto">';

                    $listAuto = getListTypeProfil();

                    //le 0 = EN, c'est le seul à avoir l'autorisation de bloquer un topic
                    echo '<option value="'.$listAuto[0]['TYPEPROFIL'].'"> '.$listAuto[0]['LIBTYPEPROFIL'].' </option>';

                echo '  </select> <br/>';
              }
              ?>

              Contenu du topic:<br/>
            <textarea name="TOPIC_CONT" form="forum" rows="10" cols="50" style="width: 100%;" required></textarea> <br/>
            <button type="submit" class="btn btn-default"> Créer un Topic</button>
          </form>
        </div>
    </div>


    <?php
  }

 ?>
