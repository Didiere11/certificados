<?php
   include_once("../Utilerias/BaseDatos.php");
   $car = consultaCarr();
   foreach ($car as $tupla){
       $idcarr = $tupla['idcarr'];
       $carr = $tupla['carr'];
       echo "<tr idcarr='$idcarr'>
          <td>$carr</td>
          <td>
             <i class='material-icons edit' data-idcarr='$idcarr' data-carr='$carr'>create</i>
             <i class='material-icons delete' data-idcarr='$idcarr'>delete_forever</i>
          </td>
      </tr>";
      }
?>