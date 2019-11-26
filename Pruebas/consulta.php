<?php
    include_once("../Utilerias/BaseDatos.php");
    $res = consultaSensado();
    foreach ($res as $renglon) {
        $idsen = $renglon['idsen'];
        $nomsensor = $renglon['nomsensor'];
        $valor = $renglon['valor'];
        echo "id=$idsen ------ nom=$nomsensor ------- valor=$valor <br>";
    }
?>