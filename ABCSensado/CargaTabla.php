<?php
      include_once("../Utilerias/BaseDatos.php"); // Carga modelo de BD
      $result = consultaSensado();         // Consulta la tabla 
      foreach ($result as $tupla){        // Recorre los registro que retorno
          $ids = $tupla['idsen'];
          $noms = $tupla['nomsensor'];
          $val = $tupla['valor'];
          $img = $tupla['imagen'];
          //   Este id es el identificador para agregar y eliminar registros del dadaTable      
          //         v
          echo "<tr id='$ids'><td>$noms</td><td>$val</td><td><img src='http://localhost/PWeb/imagenes/$img' width='80'/></td><td>
<i class='material-icons edit' data-id='$ids' data-nom='$noms' data-valor='$val'>create</i>
<i class='material-icons delete' data-id='$ids'>delete_forever</i></td></tr>";
         // En los data-campo='valor' especificamos los valores a recuperar cuando editamos
         // El numero de columnas del <tr> deberá ser el mismo que el <tr> del encabezado de
         // Tabla
      }
?>
