<?php
    include_once("../Utilerias/BaseDatos.php");
    $est = consultaEst();
    foreach ($est as $tupla){
        $idstat = $tupla['idsta'];
        $stat = $tupla['stat'];
        echo "<option value='$idstat'>$stat</option>";
    }
?>
