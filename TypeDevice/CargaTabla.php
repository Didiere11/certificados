<?php
   include_once("../Utilerias/BaseDatos.php");
   $dev = consultaDeviceType();
   foreach ($dev as $tupla){
       $idt = $tupla['iddevicetype'];
       $namt = $tupla['namedevice'];
       echo "<tr id='$idt'>
          <td>$namt</td>
          <td>
             <i class='material-icons edit' data-idt='$idt' data-namt='$namt'>create</i>
             <i class='material-icons delete' data-idt='$idt'>delete_forever</i>
          </td>
      </tr>";
      }
?>