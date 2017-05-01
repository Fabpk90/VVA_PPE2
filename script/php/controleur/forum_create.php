<?php
  include_once('../modele/forum_create.php');

  if(isset($_POST['TITRE']))
  {
   $lastTopicID = getLastTopic();

   //create the topic
   addTopic($_POST['TITRE'], $_POST['DESC'], $_SESSION['USER'], $lastTopicID+1);

   $typeProfil = getListTypeProfil();

    //je tourne dans toutes les checkbox
    //vu qu'il y a une correspondance 1:1, on peut ajouter l'autorisation direct si elle est checkée(checkbox)

    for($i = 0; $i < $_SESSION['nbProfil']; ++$i)
    {
        if(isset($_POST[''.$i]))
        {
            addAutoToTopic($lastTopicID, $typeProfil[''.$i]['TYPEPROFIL']);
        }
    }

    addPost($lastTopicID, $_POST['TOPIC_CONT'], $_SESSION['USER']);
    //ajoute le créteur aux autorisés
    if(addAutoToTopic($lastTopicID, $_SESSION['TYPEPROFIL']))
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
            <input  type="text" minlength="5"  name="TITRE" required><br/>
            Description du topic: <br/>
            <input  type="text" minlength="5" name="DESC" required> <br/>


              <?php

              //le 0 = EN, c'est le seul à avoir l'autorisation de bloquer un topic
              //TO DO: mettre un truc dynamique pour l'auto
              if($_SESSION['TYPEPROFIL'] == "EN")
              {
                echo ' Autorisation nécessaire pour voir le topic (vous êtes autorisé automatiquement) : <br/>';

                    $listAuto = getListTypeProfil();

                    //enlève le profil du créateur, il doit obligatoirement voir le topic
                    //cherche son index et le supprime
                    unset($listAuto[ array_search($_SESSION['TYPEPROFIL'], $listAuto) ]);

                    echo '<div class="radio">';

                    //créer dynamiquement des checkbox pour les auto
                    $i = 0;

                    foreach ($listAuto as $auto) {
                      echo '<label><input type="checkbox" name="'.$i.'" value="'.$auto['TYPEPROFIL'].'"/>'.$auto['LIBTYPEPROFIL'].'</label> <br/>';
                      $i++;
                    }

                    $_SESSION['nbProfil'] = $i;

                    echo '</div>';
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
