$(init);
var table = null;
var controlador = "../Utilerias/Controlador.php";

function init(){
    //Configuración del DataTable
    table = $('#dtTable').DataTable({
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    // Inicializa el formulario modal y la validación del formulario
    $('#ventanaModal').modal();
    validateForm();

    // Clic del boton circular +
    $('#add').on("click", function(){
        $('#idc').val('');
        $('#nomc').val('');
        $('#ventanaModal').modal('open');
        $('#nomc').focus();
    });

    // Clic del boton Guardar del formulario modal
    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    // Clic del icono Editar del DataTable 
    $(document).on("click", '.edit', function(){
        var id = $(this).attr("data-id");
        var nom = $(this).attr("data-nom");
        $('#idc').val(id);
        $('#nomc').val(nom);
        $('#ventanaModal').modal('open');
        $('#nomc').focus();
    });

    // Clic del icono eliminar del DataTable
    $(document).on("click", '.delete', function(){
        var idc = $(this).attr("data-id");
        var parametros = "idc=" + idc + "&accion=Eliminar&tabla=Clasif";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idc>0){
                        // Elimina el registro del DataTable
                        table.row('#' + data.idc).remove().draw();
                    }

                    M.toast({html: 'Clasificación Eliminada', classes: 'rounded blue lighten-2'});
                }
            } 
        });// fin de AJAX
    });
}

// Código de la validación del formulario modal
function validateForm(){
    $('#formulario').validate({
        rules:{
            nomc:{required:true, minlength:4, maxlength:80},
        },
        messages: {
            nomc:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 80 caracteres"},
        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            saveData();
        }
    });
}

// Una vez validado el formulario si dio clic en Guardar del formulario
// agrega el registro nuevo o lo actualiza usando AJAX
function saveData(){
    var idc = $("#idc").val();
    var parametros = $("#formulario").serialize() + "&tabla=Clasif";
    if (idc > 0){
        parametros = parametros + "&accion=Actualizar";
    }
    else{
        parametros = parametros + "&accion=Insertar";
    }
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#idc').val('');
                $('#nomc').val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (idc >0){
                    // Elimina el registro que se modifico del DataTable
                    table.row('#' + data.idc).remove().draw();
                }
                // Agrega el registro ya modificado o nuevo al DataTable
                var row = table.row.add([
                    data.nomc,
                    '<i class="material-icons edit" data-id="' + data.idc + '" data-nom="' + data.nomc +'">create</i><i class="material-icons delete" data-id="' + data.idc + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.idc);

                M.toast({html: 'Clasificación Guardada', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}

