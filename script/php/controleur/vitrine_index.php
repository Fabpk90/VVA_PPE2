<?php
include_once('../modele/vitrine_index.php');

if(isset($_GET['page']))
{
    echo '<div class="container-fluid">';

    $page = getPage($_GET['page']);

    echo "<h2>".$page['NOMPAGE']."</h2>";
    echo "<h3> Auteur ".$page['PRENOMPROFIL']." ".$page['NOMPROFIL']."</h3>";

    echo $page['CONTENUPAGE'];

    echo "</div>";
}
elseif($_SESSION['TYPEPROFIL'] == "EN") // il peut modifier/ajouter des pages
{
    $pages = getAllPages();
    ?>
<div class="container-fluid">
    <a href="vitrine_index_modify.php" ><button class=" text-center btn btn-primary"> Ajouter une page </button></a>

    <table class="table">
        <thead>
            <tr>
              <th>Nom de la page</th>
              <th>Auteur</th>
              <th>Contenu</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($pages as $page)
            {
                echo "<tr>";
                    echo '<td><a href="vitrine_index_modify.php?page='.$page['IDPAGE'].'.php">'.$page['NOMPAGE']."</a></td>";
                    echo "<td>".$page['AUTEURPAGE']."</td>";
                    echo "<td>".substr($page['CONTENUPAGE'], 0, 50)."</td>";
                    echo '<td><a href="vitrine_index_modify.php?page='.$page['IDPAGE'].'&do=0"<button class="btn btn-danger">Supprimer la page </a></button></td>';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
}
else
{

}

 ?>
