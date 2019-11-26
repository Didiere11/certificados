<?php
      include_once("../Utilerias/BaseDatos.php"); // Carga modelo de BD
      $clasif = consultaClasif();         // Consulta la tabla de Clasif
      foreach ($clasif as $tupla){        // Recorre los registro que retorno
          $idclasif = $tupla['idclasif'];
          $nomclasif = $tupla['nomclasif'];
          //   Este id es el identificador para agregar y eliminar registros del dadaTable      
          //         v
          echo "<tr id='$idclasif'><td>$nomclasif</td><td>
<i class='material-icons edit' data-id='$idclasif' data-nom='$nomclasif'>create</i>
<i class='material-icons delete' data-id='$idclasif'>delete_forever</i></td></tr>";
         // En los data-campo='valor' especiificamos los valores a recuperar cuando editamos
         // El numero de columnas del <tr> deberá ser el mismo que el <tr> del encabezado de
         // Tabla
      }
?>
