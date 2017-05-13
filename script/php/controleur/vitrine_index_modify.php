<?php
include_once('../modele/vitrine_index_modify.php');
include_once('../modele/vitrine_index.php');

if(isset($_GET['page'])) //modification de la page
{
    if(isset($_GET['do'])) // suppression
    {
        deletePage($_GET['page']);
        header('Location: vitrine_index.php');
    }
    else
    {
        $page = getPage($_GET['page']);

         ?>
        <div class="text-center">
            <div class="form-group">
                <form id="form" action="vitrine_index_modify.php" method="post">
                    <input name="page" hidden="true" type="text" value="<?php echo $page['IDPAGE']; ?>"/>

                    Titre de la page <br/>
                    <input name="NOMPAGE" type="text" minlength="5" value="<?php echo $page['NOMPAGE']; ?>" required/> <br/>

                    Contenu de la page <br/>
                    <textarea name="CONTENUPAGE" form="form" rows="10" cols="50" style="width: 100%;"
                        required><?php echo $page['CONTENUPAGE']; ?></textarea> <br/>

                    <button type="submit" class="btn btn-primary"> Modifier la page</button>
                </form>
            </div>
        </div>

    <?php
    }
}
else if(isset($_POST['page'])) // modification de la page dans bdd
{
    modifyPage($_POST['page'], $_SESSION['USER'], $_POST['NOMPAGE'], $_POST['CONTENUPAGE']);
    header('Location: vitrine_index.php');
}
else if (isset($_POST['NOMPAGE'])) // ajout
{
    addPage($_SESSION['USER'],$_POST['NOMPAGE'], $_POST['CONTENUPAGE']);
    header('Location: vitrine_index.php');
}
else //form pour ajout
{
    ?>
    <div class="text-center">
        <div class="form-group">
            <form id="form" action="vitrine_index_modify.php" method="post">

                Titre de la page <br/>
                <input name="NOMPAGE" type="text" minlength="5" required/> <br/>

                Contenu de la page <br/>
                <textarea name="CONTENUPAGE" form="form" rows="10" cols="50" style="width: 100%;"  required></textarea> <br/>

                <button type="submit" class="btn btn-primary"> Ajouter la page</button>
            </form>
        </div>
    </div>

    <?php
}

?>
