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
    <form id="frm1" name="frm1" method="POST" >
        <span align="center"><h4>Ejercicio Formulario</h4></span>
        <div class="row">
            <div class="input-field col s12">
                <input type="email" id="corr" name="corr" class="validate">
                <label for="corr">Ingresa tu correo:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="password" id="contra" name="contra" class="validate">
                <label for="password">Contraseña:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input type="text" id="nom" name="nom" class="validate">
                <label for="nom">Nombres:</label>
            </div>
            <div class="input-field col s6">
                <input type="text" id="apll" name="apll" class="validate">
                <label for="apll">Apellidos:</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <input type="date" id="fec" name="fec">
            </div>
        </div>
        <div class="row">
            <div class="input-field col s3">
                <p>
                    <label><input type="radio" id="sex" name="sex" checked><span>Femenino</span></label>
                </p>
                <p>
                
                    <label><input type="radio" id="sex" name="sex"><span>Masculino</span></label>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <select name="depto" id="depto">
                    <option value="52">Informatica</option>
                    <option value="102">Mantenimiento</option>
                    <option value="205">Contabilidad</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="input-field" col s3>
                <button type="submit" id="boton" name="boton" value="Enviar">Enviar</button>
                <a id="btnGuardar" name="brtGuardar" class="waves-effect waves-light btn">Guardar</a>
            </div>
        </div>
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
    <script type="text/javascript" src="./ValidaFrm.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
        $('select').formSelect();
        $('.sidenav').sidenav();
     });
   
    </script> 
</body>
</html>