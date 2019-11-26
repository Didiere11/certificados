<?php
     include_once("../Utilerias/BaseDatos.php");
     $sensado = consultaSensado();
     foreach ($sensado as $tupla){
         $id = $tupla['idsen'];
         $nom = $tupla['nomsensor'];
         $val = $tupla['valor'];
         echo "<tr><td>$id</td><td>$nom</td><td>$val</td></tr>";
     }
?>