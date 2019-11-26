<?php
   include_once("../Utilerias/BaseDatos.php");
   $rol = consultaRol();
   foreach ($rol as $tupla){
       $idrol = $tupla['idrol'];
       $nomrol = $tupla['nomrol'];
       echo "<tr id='$idrol'>
          <td>$nomrol</td>
          <td>
             <i class='material-icons edit' data-id='$idrol' data-nom='$nomrol'>create</i>
             <i class='material-icons delete' data-id='$idrol'>delete_forever</i>
          </td>
      </tr>";
      }
?>