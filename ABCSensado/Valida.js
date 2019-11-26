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
    $('#ventanamodal').modal();
    validateForm();

    // Clic del boton circular +
    $('#add').on("click", function(){
        $('#ids').val('');
        $('#noms').val('');
        $('#valor').val('');
        $('#ventanamodal').modal('open');
        $('#noms').focus();
    });

    // Clic del boton Guardar del formulario modal
    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    // Clic del icono Editar del DataTable 
    $(document).on("click", '.edit', function(){
        var id = $(this).attr("data-id");
        var nom = $(this).attr("data-nom");
        var valor = $(this).attr("data-valor");
        $('#ids').val(id);
        $('#noms').val(nom);
        $('#valor').val(valor);
        $('#ventanamodal').modal('open');
        $('#noms').focus();
    });

    // Clic del icono eliminar del DataTable
    $(document).on("click", '.delete', function(){
        var ids = $(this).attr("data-id");
        var parametros = "ids=" + ids + "&accion=Eliminar&tabla=Sensado";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (ids>0){
                        // Elimina el registro del DataTable
                        table.row('#' + data.ids).remove().draw();
                    }

                    M.toast({html: 'Registro Eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });// fin de AJAX
    });
}

// Código de la validación del formulario modal
function validateForm(){
    $('#formulario').validate({
        rules:{
            noms:{required:true, minlength:4, maxlength:40},
            valor:{required:true, number:true},
        },
        messages: {
            noms:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 40 caracteres"},
            valor:{required:"Valor Requerido",number:"Solo numeros"},
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
    var ids = $("#ids").val();
    var parametros = $("#formulario").serialize() + "&tabla=Sensado";
    if (ids > 0){
        parametros = parametros +  "&accion=Actualizar";
    }
    else{
        parametros = parametros +  "&accion=Insertar";
    }
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#ids').val('');
                $('#noms').val('');
                $('#valor').val('');
                $('#ventanamodal').modal('close');
                var data = respuesta['data'];
                if (ids >0){
                    // Elimina el registro que se modifico del DataTable
                    table.row('#' + data.ids).remove().draw();
                }
                // Agrega el registro ya modificado o nuevo al DataTable
                var row = table.row.add([
                    data.noms,
                    data.valor,
                    '<i class="material-icons edit" data-id="' + data.ids + '" data-nom="' + data.noms +'"  data-valor="' + data.valor +'">create</i><i class="material-icons delete" data-id="' + data.ids + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.ids);

                M.toast({html: 'Registro Guardad0o', classes: 'rounded blue lighten-2'});
            }
        } 
    });
}

