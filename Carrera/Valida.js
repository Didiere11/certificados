$(init);
var table = null;
var controlador = "../Utilerias/Controlador.php";

function init(){
  table = $('#dtTable').DataTable({
      "alengtMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
      "iDisplayLength" : 15
  });
  //Inicializa la ventana modal
  $('#ventanaModal').modal();
  validaForm();
  //Si precionamos más
  $('#add').on("click", function(){
    //Abre la ventana modal
    $('#ventanaModal').modal('open');
    //manda el foco a la línea para escribir el nombre
    $('#carr').focus();
  });
  
  //Guardamos
  $('#guardar').on("click", function(){
    $('#formulario').submit();
  });

//Editar

  $(document).on("click", '.edit', function(){
    var idcarr = $(this).attr("data-idcarr");
    var carr = $(this).attr("data-carr");
    $('#idcarr').val(idcarr);
    $('#carr').val(carr);
    $('#ventanaModal').modal('open');
    $('#carr').focus();
    });



//Eliminar
  $(document).on("click", '.delete', function(){
    var idcarr = $(this).attr("data-idcarr");
    var parametros = "idcarr= " + idcarr + "&accion=Eliminar&tabla=Carr";
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                var data = respuesta['data'];
                if (idcarr>0){
                    table.row('#' + idcarr).remove().draw();
                }
                M.toast({html: 'Carrera Eliminada', classes: 'rounded blue lighten-2'});
            }
        } 
      });
    });
}

//Validación del formulario
function validaForm(){
    $('#formulario').validate({
        rules:{
            carr:{ required:true, minlength:4, maxlength:60 },
          
        },
        messages:{
            carr:{required:'Campo Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 60 caracteres'},
          
        },
        errorElement:"div",
        errorClass:"invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)
        },
        submitHandler: function(form){
            guardarRegistro();
        }
    });
}

function guardarRegistro(){
  var idcarr = $("#idcarr").val();
  var parametros = $("#formulario").serialize()+ "&tabla=Carr";
  if(idcarr > 0){
    parametros = parametros + "&accion=Actualizar";
  }else{
    parametros = parametros + "&accion=Insertar";
  }

$.ajax({
  type: "post",
  url: controlador,
  dataType:'json',
  data: parametros,
  success: function (respuesta){
    if(respuesta['status']==1){
      $('#idcarr').val('');
      $('#carr').val('');
      $('#ventanaModal').modal('close');
      var  data = respuesta ['data'];
      if (idcarr > 0){
        table.row('#' + data.idcarr).remove().draw();
      }

      var row = table.row.add([
        data.carr,
        '<i class="material-icons edit" data-idcarr ="' + data.idcarr + '" data-carr= "' + data.carr + '" >create</i>  <i class="material-icons delete" data-idcarr ="' + data.idcarr + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.idcarr);
        M.toast({html: 'Carrera Guardada', classes: 'rounded blue lighten-2'});
    }
  } 
  });
}
