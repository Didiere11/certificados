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
    $('#namt').focus();
  });
  
  //Guardamos
  $('#guardar').on("click", function(){
    $('#formulario').submit();
  });

//Editar

  $(document).on("click", '.edit', function(){
    var id = $(this).attr("data-idt");
    var nom = $(this).attr("data-namt");
    $('#idt').val(id);
    $('#namt').val(nom);
    $('#ventanaModal').modal('open');
    $('#namt').focus();
    });

//Eliminar
  $(document).on("click", '.delete', function(){
    var idt = $(this).attr("data-idt");
    var parametros = "idt= " + idt + "&accion=Eliminar&tabla=DeviceType";
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                var data = respuesta['data'];
                if (idt>0){
                    table.row('#' + idt).remove().draw();
                }
                M.toast({html: 'Tipo de Dispositivo Eliminado', classes: 'rounded blue lighten-2'});
            }
        } 
      });
    });
}

//Validación del formulario
function validaForm(){
    $('#formulario').validate({
        rules:{
            namt:{ required:true, minlength:4, maxlength:100 },
        },
        messages:{
            nomr:{required:'Campo Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 100 caracteres'},
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
  var idt = $("#idt").val();
  var parametros = $("#formulario").serialize()+ "&tabla=DeviceType";
  if(idt > 0){
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
      $('#idt').val('');
      $('#namt').val('');
      $('#ventanaModal').modal('close');
      var  data = respuesta ['data'];
      if (idt > 0){
        table.row('#' + data.idt).remove().draw();
      }

      var row = table.row.add([
        data.namt,
        '<i class="material-icons edit" data-idt ="' + data.idt + '" data-namt= "' + data.namt + '" >create</i>  <i class="material-icons delete" data-idt ="' + data.idt + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.idt);
        M.toast({html: 'Tipo de Dispositivo Guardado', classes: 'rounded blue lighten-2'});
    }
  } 
  });
}
