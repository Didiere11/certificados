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
<body>
<?php
       include_once("../Utilerias/BaseDatos.php");
       $idopc = "opcTipoDisp";
       $res = ValidaOpcion($idopc);
       if ($res == "")
            header("location:../Acceso/");
       else
            include_once("../resources/html/header.php");        
?>
<br>

  <div class="container">
      <div class="row">
          <div class="col s12 m8 offset-m2">
              <div class="card">
                    <a id="add" class="btn-floating btn-large waves-effect waves -light right">
                        <i class="material-icons blue">add</i>
                    </a>
                    <div class="card-content">
                        <span class="card-title">Tipo de Dispositivo</span>
                        <table id="dtTable" class="higlight bordered dataTable">
                            <thead>
                                <tr><th>Nombre del Dispositivo</th><th></th></tr>
                            </thead>
                            <tbody>
                                <?php
                                 include_once("./CargaTabla.php") 
                                ?>
                            </tbody>
                        </table>
                    </div>
              </div>
          </div>
      </div>
  </div>

<!--                    Ventana modal -->
<div id="ventanaModal" class="modal #e0f7fa cyan lighten-5">
   <div class="modal-content">
      <h4>Detalle del Tipo de Dispositivo</h4>
      <br>
      <form id="formulario" method="post">
         <div class="row">
            <div class="input-field_col_s12">
                    <input type="hidden" name="idt" id="idt">
                    <input type="text" name="namt" id="namt" class="validate">
                    <label for="namt">Nombre del Tipo Dispositivo:</label>
            </div>
         </div>
      </form>
      </div>
      <div class="modal-footer #80deea cyan lighten-3">
         <a class="waves-effect waves-light btn-small blue" id="guardar">Guardar</a>
         <!--<a id="guardar" class="modal-action waves-effect weaves-green btn-flat" >Guardar</a>-->
      </div>
</div>

<?php include_once("../resources/html/footer.php"); ?>

<script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/dataTables.materialize.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>     
    <script type="text/javascript" src="../resources/js/Cursos.js"></script>
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