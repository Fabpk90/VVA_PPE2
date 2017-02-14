<?php
include('../modele/news_modify.php');

if(isset($_GET['idnews']))
{
    if(isUserAuthorNews($_SESSION['USER'], $_GET['idnews']))
    {
        $news = get_single_news($_GET['idnews']);

        ?>

        <div class="text-center">
            <div class="form-group">
                <form id="form" action="news_modify.php" method="post">
                    <input name="IDNEWS" hidden="true" type="text" value="<?php echo $news['IDNEWS']; ?>"/>

                    Titre de la news <br/>
                    <input name="TITLENEWS" type="text" minlength="5" value="<?php echo $news['TITRENEWS']; ?>" required/> <br/>

                    Date de la news <br/>
                    <input name="DTNEWS" type="date" value="<?php  print($news['DTNEWS']); ?>" required/> <br/>

                    Contenu de la news <br/>
                    <textarea name="CONTNEWS" form="form" rows="10" cols="50" style="width: 100%;" value="<?php echo $news['LIBNEWS']; ?>" required></textarea> <br/>

                    <button type="submit" class="btn btn-default"> Mettre à jour la news</button>
                </form>
            </div>
        </div>

        <?php
    }
}
//maj de la news
elseif (isset($_POST['TITLENEWS']))
{
    update_news($_POST['IDNEWS'], $_POST['TITLENEWS'], $_POST['DTNEWS'], $_POST['CONTNEWS']);

    echo "News mise à jour!";
}


 ?>
