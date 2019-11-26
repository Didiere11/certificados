<?php
    include_once("../Utilerias/BaseDatos.php");
    $in = consultaIngre();
    foreach ($in as $tupla){
        $idingr = $tupla['idingr'];
        $ingreso = $tupla['ingreso'];
        echo "<option value='$idingr'>$ingreso</option>";
    }
?>
