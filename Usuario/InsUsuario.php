<?php
      include_once("../Utilerias/BaseDatos.php");
      $post = $_POST;

      $XFile = $_FILES["arch"];
      $nomArch = md5($XFile["name"]);
      $tipoArchivo = strtolower(pathinfo($XFile["name"],PATHINFO_EXTENSION));
      if ($tipoArchivo == "png" || $tipoArchivo == "jpg")
      {
            $nom = "../upLoads/$nomArch.$tipoArchivo";
            if (move_uploaded_file($XFile["tmp_name"],$nom)){
                  $accion = "Insertar";
                  $tabla = "Usuario";
                  $funcion = $accion.$tabla;
                  $result = $funcion($post,$nom);
                  if ($result){
                        $response['status']=1; // Regresamos 1 por que se agrego con exito
                        // En data regresamos el contenido de las cajas de texto y el consecutivo
                        $response['data']=$post; 
                  }
                  else{
                        $response['status']=0; // Regresamos 0 por que fallo el insert de clasif
                        $response['data']=$post;
                  }
            }
      }else{
            $response['status']=0; // Regresamos 0 por que fallo el insert de clasif
            $response['data']=$post;
      }
      // Convertimos el arreglo response en formato de JSON, para 
      // poder manipularlo en JAVASCRIPT
      echo json_encode($response);
?>