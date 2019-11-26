<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clasificaciones</title>
    <!-- Importa librerias de estilos de Materialize, DataTable e Iconos -->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="../css/dataTables.materialize.css"/>
    <link type="text/css" rel="stylesheet" href="../css/default.css"/>
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />
</head>
<body>
<?php
       include_once("../Utilerias/BaseDatos.php");
       $idopc = "opcClasif";
       $res = ValidaOpcion($idopc);
       if ($res == "")
            header("location:../Acceso/");
       else
            include_once("../resources/html/header.php");        
?>

<!-- Colocar su código a partir de este comentario -->
<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <a id="add" class="btn-floating btn-large waves-effect waves-light right blue lighten-2">
                    <i class="material-icons">add</i>
                </a>
                <div class="card-content">
                    <span class="card-title">Clasificaciones</span>
                    <table id="dtTable" class="highlight bordered dataTable">
                        <thead>
                            <tr><th>Nombre de la Clasificación</th><th></th></tr>
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
        <h4>Detalles Clasificación</h4>
        <br>
        <form id="formulario" method="post">
            <div class="row">
                <div class="input-field_col_s12">
                    <input type="hidden" name="idc" id="idc">
                    <input type="text" name="nomc" id="nomc" class="validate">
                    <label for="nomc">Nombre de la Clasificación:</label>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a id="guardar" class="modal-action waves-effect waves-green btn-flat">Guardar</a>
    </div>
</div>
<!-- La siguiente linea incluye el footer de nuestra página web -->
<?php include_once("../resources/html/footer.php"); ?>
<!-- Importa librerias de JavaScript de Jquery, Jaquery Validate, DataTable
     y Materialize                                                       -->
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