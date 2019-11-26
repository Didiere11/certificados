<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />
</head>
<body background="../imagenes/archivo.jpg">
<?php
      include_once("../Utilerias/BaseDatos.php");
       $idopc = "opcReportes";
      $res = ValidaOpcion($idopc);
       if ($res == "")
          header("location:../Acceso/");
       else
           include_once("../resources/html/header.php");    
?>
<form action="BaseDatos.php" name="frm1" id="frm1" mehod="POST">

<div class="row">
                                <div class="col s6 m4">
                                <div class="card">
                                    <div class="card-image">
                                    <img src="../imagenes/todos.jpg" width="230" height="150">
                                    <span class="card-title">Todos</span>
                                    </div>
                                    <div class="card-content">
                                    <p>Reporte de todos los reportes</p>
                                    </div>
                                    <div class="card-action">
                                    <a href="http://localhost/pwebe/informes/Reportes/reportestatus.php">Generrar Reporte</a>
                                    </div>
                                </div>
                                </div>

                                <div class="col s6 m4">
                                <div class="card">
                                    <div class="card-image">
                                    <img src="../imagenes/carrera.jpg" width="230" height="150">
                                    <span class="card-title">Reportes Terminados</span>
                                    </div>
                                    <div class="card-content">
                                    <p>Reporte de los Certificados terminados</p>
                                    </div>
                                    <div class="card-action">
                                    <a href="http://localhost/pwebe/informes/Reportes/reportesterminados.php">Generrar Reporte</a>
                                    </div>
                                </div>
                                </div>

                                <div class="col s6 m4">
                                <div class="card">
                                    <div class="card-image" >
                                    <img src="../imagenes/terminados.jpg" width="230" height="150">
                                    <span class="card-title">Reportes por carrera</span>
                                    </div>
                                    <div class="card-content">
                                    <p>Reporte de la catidad de certificados por carrera</p>
                                    </div>
                                    <div class="input-field col s6 m6" >
                                        <select name="idcarr" id="idcarr">
                                        <?php include_once("./llenacarrera.php");
                                        ?>
                                        <?php if(isset($_POST['idcarr'])){
                                            $idcarr=$_POST['idcarr'];
                                        } ?>
                                        </select>
                                        <label for="idcarr">Carrera:</label>
                                    </div>
                                    <div class="card-action">
                                    <a id="imp" type="submit" class="modal-action waves-effect waves-green btn-flat" href="http://localhost/pwebe/informes/Reportes/reportescarreras.php">Generar Reporte</a>                                    </div>
                                </div>
                                </div>

                               </div> 

</form>
   


<?php include_once("../resources/html/footer.php"); ?>

<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script> 
    <script type="text/javascript" src="./Valida.js"></script>    
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').formSelect();
            $('.sidenav').sidenav();
            $(".dropdown-trigger").dropdown();
        });
    </script> 
</body>
</html>