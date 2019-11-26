<?php
      include_once("../Utilerias/BaseDatos.php");
      $post = $_POST;
      $accion = $post["accion"];
      $tabla = $post["tabla"];
      $funcion = $accion.$tabla;
      $result = $funcion($post);
      if ($result){
            $response['status']=1; // Regresamos 1 por que se agrego con exito
            // En data regresamos el contenido de las cajas de texto y el consecutivo
            $response['data']=$post; 
      }
      else{
            $response['status']=0; // Regresamos 0 por que fallo el insert de clasif
            $response['data']=$post;
      }
      // Convertimos el arreglo response en formato de JSON, para 
      // poder manipularlo en JAVASCRIPT
      echo json_encode($response); 
?>