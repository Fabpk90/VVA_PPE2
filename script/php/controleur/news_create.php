<?php

include_once("../modele/news_create.php");

if(isset($_POST['TITLENEWS']))
{
    add_news($_POST['TITLENEWS'], $_POST['DTNEWS'], $_POST['CONTNEWS'], $_SESSION['USER']);
}
else
{
    ?>
<div class="text-center">
    <div class="form-group">
        <form id="form" action="news_create.php" method="post">
            Titre de la news <br/>
            <input name="TITLENEWS" type="text" minlength="5" required/> <br/>

            Date de la news <br/>
            <input name="DTNEWS" type="date" value="<?php  print(date("Y-m-d")); ?>" required/> <br/>

            Contenu de la news <br/>
            <textarea name="CONTNEWS" form="form" rows="10" cols="50" style="width: 100%;" required></textarea> <br/>

            <button type="submit" class="btn btn-default"> Créer la news</button>
        </form>
    </div>
</div>
    <?php
}
 ?>
