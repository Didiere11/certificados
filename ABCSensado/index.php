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
<!-- La siguiente linea importa un programa de php el cual incluye un menu 
  de tipo NavBar de Materialize y corresponde al Header de la página-->
<?php include_once("../resources/html/header.php"); ?>
<!-- Colocar su código a partir de este comentario -->
<div class="container">
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
                <a id="add" class="btn-floating btn-large waves-effect waves-light right blue lighten-2">
                    <i class="material-icons">add</i>
                </a>
                <div class="card-content">
                    <span class="card-title">Sensado</span>
                    <table id="dtTable" class="highlight bordered dataTable">
                        <thead>
                            <tr><th>Nombre del Sensor</th><th>Valor Sensado</th><th>Imagen</th><th></th></tr>
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
<div id="ventanamodal" class="modal">
    <div class="modal-content">
        <h4>Detalle del Sensado</h4>
        <br>
        <form id="formulario" method="post">
            <div class="row">
                <div class="input-field_col_s12">
                    <input type="hidden" name="ids" id="ids">
                    <input type="text" name="noms" id="noms" class="validate">
                    <label for="noms">Nombre del Sensor:</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field_col_s12">
                    <input type="text" name="valor" id="valor" class="validate">
                    <label for="valor">Valor Sensado:</label>
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