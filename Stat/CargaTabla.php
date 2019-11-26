<?php
   include_once("../Utilerias/BaseDatos.php");
   $st = consultaEst();
   foreach ($st as $tupla){
       $idstat = $tupla['idsta'];
       $stat = $tupla['stat'];
       echo "<tr idsta='$idstat'>
          <td>$stat</td>
          <td>
             <i class='material-icons edit' data-idsta='$idstat' data-stat='$stat'>create</i>
             <i class='material-icons delete' data-idsta='$idstat'>delete_forever</i>
          </td>
      </tr>";
      }
?>