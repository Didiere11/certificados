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
    $('#stat').focus();
  });
  
  //Guardamos
  $('#guardar').on("click", function(){
    $('#formulario').submit();
  });

//Editar

  $(document).on("click", '.edit', function(){
    var idstat = $(this).attr("data-idsta");
    var stat = $(this).attr("data-stat");
    $('#idsta').val(idstat);
    $('#stat').val(stat);
    $('#ventanaModal').modal('open');
    $('#stat').focus();
    });



//Eliminar
  $(document).on("click", '.delete', function(){
    var idstat = $(this).attr("data-idsta");
    var parametros = "idsta= " + idstat + "&accion=Eliminar&tabla=Est";
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                var data = respuesta['data'];
                if (idstat>0){
                    table.row('#' + idstat).remove().draw();
                }
                M.toast({html: 'Estatus Eliminado', classes: 'rounded blue lighten-2'});
            }
        } 
      });
    });
}

//Validación del formulario
function validaForm(){
    $('#formulario').validate({
        rules:{
            stat:{ required:true, minlength:4, maxlength:40 },
          
        },
        messages:{
            stat:{required:'Campo Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 40 caracteres'},
          
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
  var idstat = $("#idsta").val();
  var parametros = $("#formulario").serialize()+ "&tabla=Est";
  if(idstat > 0){
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
      $('#idsta').val('');
      $('#stat').val('');
      $('#ventanaModal').modal('close');
      var  data = respuesta ['data'];
      if (idstat > 0){
        table.row('#' + data.idstat).remove().draw();
      }

      var row = table.row.add([
        data.stat,
        '<i class="material-icons edit" data-idsta ="' + data.idstat + '" data-stat= "' + data.stat + '" >create</i>  <i class="material-icons delete" data-idsta ="' + data.idstat + '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id', data.idstat);
        M.toast({html: 'Status Guardado', classes: 'rounded blue lighten-2'});
    }
  } 
  });
}
