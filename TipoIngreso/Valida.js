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
    $('#ingreso').focus();
  });
  
  //Guardamos
  $('#guardar').on("click", function(){
    $('#formulario').submit();
  });

//Editar

  $(document).on("click", '.edit', function(){
    var idingr = $(this).attr("data-idingr");
    var ingreso = $(this).attr("data-ingreso");
    $('#idingr').val(idingr);
    $('#ingreso').val(ingreso);
    $('#ventanaModal').modal('open');
    $('#ingreso').focus();
    });



//Eliminar
  $(document).on("click", '.delete', function(){
    var idingr = $(this).attr("data-idingr");
    var parametros = "idingr = " + idingr + "&accion=Eliminar&tabla=Ingre";
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                var data = respuesta['data'];
                if (idingr>0){
                    table.row('#' + idingr).remove().draw();
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
            ingreso:{ required:true, minlength:4, maxlength:60 },
          
        },
        messages:{
            ingreso:{required:'Campo Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 60 caracteres'},
          
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
  var idingr = $("#idingr").val();
  var parametros = $("#formulario").serialize()+ "&tabla=Ingre";
  if(idingr > 0){
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
      $('#idingr').val('');
      $('#ingreso').val('');
      $('#ventanaModal').modal('close');
      var  data = respuesta ['data'];
      if (idingr > 0){
        table.row('#' + data.idingr).remove().draw();
      }

      var row = table.row.add([
        data.ingreso,
        '<i class="material-icons edit" data-idingr ="' + data.idingr + '" data-ingreso= "' + data.ingreso + '" >create</i>  <i class="material-icons delete" data-idingr ="' + data.idingr + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.idingr);
        M.toast({html: 'Tipo de Ingreso Guardada', classes: 'rounded blue lighten-2'});
    }
  } 
  });
}
