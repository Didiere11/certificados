<?php
      include_once("../Utilerias/BaseDatos.php");
      $idrol = $_GET["idr"];
      $menu = opcDisponibles($idrol);
      echo "<table id='disp' class='highlight bordered dataTable'>
      <thead>
          <tr><th>Identificador</th><th>Nombre Menu</th><th>Orden del Menu</th><th></th></tr>
      </thead>
      <tbody>
";
      foreach ($menu as $tupla){
          $idopcmenu = $tupla['idopcmenu'];  
          $idmenu = $tupla['idmenu'];
          $nommenu = $tupla['nommenu'];
          $orden = $tupla['orden'];
          echo "<tr id='$idopcmenu'><td>$idmenu</td><td>$nommenu</td><td>$orden</td><td>
<i class='material-icons inserta' data-idopc='$idopcmenu' data-idmenu='$idmenu' data-nommenu='$nommenu'data-orden='$orden'>check</i></td></tr>";
      }
      echo "</table>";
?>