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

<div class="container">
    <div class="row">
        <div class="col s12 ">
            <div class="card">
            
               <a id="print" class="btn-floating btn-large waves-effect waves-light right blue lighten-2">
                    <i class="material-icons">local_printshop</i>
                </a>
                <a id="add" class="btn-floating btn-large waves-effect waves-light right blue lighten-2">
                    <i class="material-icons">add</i>
                </a>
                <div class="card-content">
                    <span align="center" class="card-title">Estatus de Certificados</span>
                    <table id="dtTable" class="highlight bordered dataTable">
                   
                        <thead>
                            <tr><th>numero de control</th><th>Nombre</th><th>Apellido</th><th>Status</th><th>Correo</th><th>telefono</th><th>Carrera</th><th>Tipo de Ingreso:</th><th></th></tr>
                        </thead>
                        <tbody>
                            <?php 
                                include_once("./CargaTabla.php");  
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
<!--                        Ventana Modal               --> 
<div id="ventanaModal" class="modal">
    <div class="modal-content">
        <h4>ALta y actualizacion de Certificados</h4>
        <br>
        <form id="formulario" method="post">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="nocontrol" id="nocontrol" class="validate">
                    <label for="nocontrol">Numero de control:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="nom" id="nom" class="validate">
                    <label for="nom">Nombre:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="appe" id="appe" class="validate">
                    <label for="appe">Apellido:</label>
                </div>
            </div>
               <div class="input-field col s6 m6">
                    <select name="idsta" id="idsta">
                       <?php include_once("./llenaSelect.php"); ?>
                    </select>
                    <label for="idsta">Status:</label>
                </div>
                <div class="input-field col s6 m6" >
                    <select name="idcarr" id="idcarr">
                       <?php include_once("./llenacarrera.php"); ?>
                    </select>
                    <label for="idcarr">Carrera:</label>
                </div>
                <div class="input-field col s6 m6" >
                    <select name="idingr" id="idingr">
                       <?php include_once("./llenaingreso.php"); ?>
                    </select>
                    <label for="idingr">Tipo de Ingreso:</label>
                </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="email" name="corr" id="corr" class="validate">
                    <label for="corr">Correo:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="tel" id="tel" class="validate">
                    <label for="tel">Telefono:</label>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a id="guardar" class="modal-action waves-effect waves-green btn-flat">Guardar</a>
    </div>
</div>

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