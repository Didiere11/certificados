<?php
    if  (!isset($_SESSION)){
        session_start();
      }
    ob_start();
    session_regenerate_id(true);
    $idsnew = session_id();  
    $_SESSION["correo"]="";
    $_SESSION = array();
    session_destroy();
    header("location:../Home/");
?>