<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plantilla Home</title>
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
<form id="formulario" method="post" action="../Informes/Reportes/rptSensado.php">
            <h3 align="center">Informe de Sensado</h3>
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" name="valorIni" id="valorIni" class="validate">
                    <label for="valorIni">Valor Inicial:</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" name="valorFin" id="valorFin" class="validate">
                    <label for="valorFin">Valor Final:</label>
                </div>
            </div>
            <div class="row">
                <button id="boton" name="boton" type="submit" class="btn waves-effect waves-light  btn-large">
                    <i class="material-icons left">android</i>Generar Informe
                </button>
            </div>
            <a href="http://localhost/PWeb/Informes/Reportes/rptUsuarios.php" target="_top" >Informe de Usuarios</a>
        </form>
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
    <script type="text/javascript">
     $(document).ready(function(){
        $('select').formSelect();
        $('.sidenav').sidenav();
        $(".dropdown-trigger").dropdown();
     });
   
    </script> 
</body>
</html>