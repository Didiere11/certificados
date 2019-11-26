<?php
    include_once("../Utilerias/BaseDatos.php");
    $rol = consultaRol();
    foreach ($rol as $tupla){
        $id = $tupla['idrol'];
        $nom = $tupla['nomrol'];
        echo "<option value='$id'>$nom</option>";
    }
?>
