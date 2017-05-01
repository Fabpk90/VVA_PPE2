<?php
include('../modele/vitrine_act.php');

echo '<div class="container-fluid">';
echo '<table class="table">';

?>
<thead>
    <tr>
      <th>Nom</th>
      <th>Durée</th>
      <th>Limite d'âge</th>
      <th>Tarif</th>
      <th>Places libres</th>
      <th>Description</th>
      <th>Commentaire</th>
      <th>Difficulté</th>
    </tr>
</thead>

<tbody>
<?php

foreach ($anims as $anim) {

echo "<tr>";
    echo "
         <td>".$anim['NOMANIM']."</td>

         ";
echo "</tr>";
}
?>
        </tbody>
    </table>
</div>
