<?php
      include_once("../Utilerias/BaseDatos.php"); // Carga modelo de BD
      $emp = consultaEmpleado();         // Consulta la tabla de Clasif
      foreach ($emp as $tupla){        // Recorre los registro que retorno
          $ide = $tupla['idemp'];
          $nome = $tupla['nomemp'];
          $ape = $tupla['apemp'];
          $tele =$tupla['telemp'];
          $numcon =$tupla['numcontrol'];

          //   Este id es el identificador para agregar y eliminar registros del dadaTable      
          //         v
          echo "<tr id='$ide'><td>$nome</td><td>$ape</td><td>$tele</td><td>$numcon</td><td>
<i class='material-icons edit' data-id='$ide' data-nome='$nome' data-ape='$ape' data-tele='$tele' data-numcon='$numcon'>create</i>
<i class='material-icons delete' data-id='$ide'>delete_forever</i></td></tr>";
         // En los data-campo='valor' especiificamos los valores a recuperar cuando editamos
         // El numero de columnas del <tr> deberá ser el mismo que el <tr> del encabezado de
         // Tabla
      }
?>
