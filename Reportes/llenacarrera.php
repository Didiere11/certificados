<?php
    include_once("../Utilerias/BaseDatos.php");
    $car = consultaCarr();
    foreach ($car as $tupla){
        $idcarr = $tupla['idcarr'];
        $carr = $tupla['carr'];
        echo "<option value='$idcarr'>$carr</option>";
    }
?>
