<?php
include('../modele/vitrine_anim.php');

echo '<div class="container-fluid">';

$anims = getAllAnim();

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

$difficulte = ["Facile", "Normal", "Difficile"];

foreach ($anims as $anim) {

$nbPlace = getNbPlacesLibres($anim['CODEANIM']);

echo "<tr>";
    echo "
         <td>"; echo '<a href="vitrine_act.php?anim='.$anim['CODEANIM'].'" data-toggle="tooltip" title="Cliquez sur l\'animation pour voir ses activités">'; echo $anim['NOMANIM']."</td>
         <td>".$anim['DUREEANIM']."</td>
         <td>".$anim['LIMITEAGE']."</td>
         <td>".$anim['TARIFANIM']."</td>
         <td>".$nbPlace."</td>
         <td>".$anim['DESCRIPTANIM']."</td>
         <td>".$anim['COMMENTANIM']."</td>
         <td>".$difficulte[ $anim['DIFFICULTEANIM'] ]."</td>
         ";
echo "</tr>";
}
?>
        </tbody>
    </table>
</div>
