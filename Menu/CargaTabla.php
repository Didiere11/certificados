<?php
      include_once("../Utilerias/BaseDatos.php");
      $menu = consultaMenu();
      foreach ($menu as $tupla){
          $idopcmenu = $tupla['idopcmenu'];  
          $idmenu = $tupla['idmenu'];
          $nommenu = $tupla['nommenu'];
          $orden = $tupla['orden'];
          echo "<tr id='$idopcmenu'><td>$idmenu</td><td>$nommenu</td><td>$orden</td><td>
<i class='material-icons edit' data-idopc='$idopcmenu' data-idmenu='$idmenu' data-nommenu='$nommenu'data-orden='$orden'>create</i>
<i class='material-icons delete' data-idopc='$idopcmenu'>delete_forever</i></td></tr>";
      }
?>
