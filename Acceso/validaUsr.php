<?php
      include_once("../Utilerias/BaseDatos.php");
      $post = $_POST;
      if  (!isset($_SESSION))
            session_start();

      $idSess = session_id();

      $result = ValidaUsr($post, $idSess,$img);
      if ($result){
            $_SESSION["correo"]=$post["usr"];
            $_SESSION["imagen"]=$img;
            $response['status']=1;
            $response['data']=$post;
      }
      else{
            $response['status']=0;
            $response['data']=$post;
      }
      echo json_encode($response);
?>