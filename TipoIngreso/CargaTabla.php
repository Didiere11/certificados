<?php
   include_once("../Utilerias/BaseDatos.php");
   $ing = consultaIngre();
   foreach ($ing as $tupla){
       $idingr = $tupla['idingr'];
       $ingreso = $tupla['ingreso'];
       echo "<tr idingr='$idingr'>
          <td>$ingreso</td>
          <td>
             <i class='material-icons edit' data-idingr='$idingr' data-ingreso='$ingreso'>create</i>
             <i class='material-icons delete' data-idingr='$idingr'>delete_forever</i>
          </td>
      </tr>";
      }
?>