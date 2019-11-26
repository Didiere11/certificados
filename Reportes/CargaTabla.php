<?php
      include_once("../Utilerias/BaseDatos.php");
      $reporte = consultareportes();
      foreach ($reporte as $tupla){
          $nocontrol = $tupla['nocontrol'];  
          $nom = $tupla['nombre'];
          $appe = $tupla['apellidos'];
          $idsta = $tupla['stat'];
          $corr = $tupla['correo'];
          $tel = $tupla['telefono'];
          $idcarr = $tupla['carr'];
          $idingr = $tupla['ingreso'];
          echo "<tr id='$nocontrol'><td>$nocontrol</td><td>$nom</td><td>$appe</td><td>$idsta</td><td>$corr</td><td>$tel</td><td>$idcarr</td><td>$idingr</td><td>
<i class='material-icons edit' data-nocontrol='$nocontrol' data-nom='$nom' data-appe='$appe'data-stat='$idsta' data-corr='$corr' data-tel='$tel' data-carr='$idcarr' data-ingreso='$idingr'>create</i>
<i class='material-icons delete' data-nocontrol='$nocontrol'>delete_forever</i></td></tr>";
      }
?>