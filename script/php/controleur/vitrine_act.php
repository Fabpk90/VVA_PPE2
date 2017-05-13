<?php
include('../modele/vitrine_act.php');

$acts = getAllAct($_GET['anim']);

if($acts == null )
    echo "Aucune activité n'est disponible pour cette animation.";
else {
    echo '<div class="container-fluid">';
    echo '<table class="table">';

    ?>
    <thead>
        <tr>
          <th>Date</th>
          <th>Etat</th>
          <th>Heure RDV</th>
          <th>Tarif</th>
          <th>Heure Début</th>
          <th>Heure Fin</th>
          <th>Objectif</th>
        </tr>
    </thead>

    <tbody>
    <?php

    foreach ($acts as $act)
    {

        $etatAct = getEtatAct($act['CODEETATACT'])['NOMETATACT'];

        echo "<tr>";
            echo "
                 <td>".$act['DATEACT']."</td>
                 <td>".$etatAct."</td>
                 <td>".$act['HRRDVACT']."</td>
                 <td>".$act['PRIXACT']."</td>
                 <td>".$act['HRDEBUTACT']."</td>
                 <td>".$act['HRFINACT']."</td>
                 <td>".$act['OBJECTIFACT']."</td>
                 ";
        echo "</tr>";
    }
    ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>
