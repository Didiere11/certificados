//   Archivo de JavaScript, creado para validar e implementar
//   el clic de los botones
//   AGZ  Oct-2019
$(init);
var table = null;

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
        $('#ventanaModal').modal('open');
        $("#ide").val('');
        $("#nome").val('');
        $("#ape").val('');
        $("#tele").val('');
        $("#numcon").val('');
        $("#nome").focus();
    });

    // Clic del boton Guardar del formulario modal
    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    // Clic del icono Editar del DataTable 
    $(document).on("click", '.edit', function(){
        $('#ventanaModal').modal('open');
        $("#ide").val($(this).attr('data-id'));
        $("#nome").val($(this).attr('data-nome'));
        $("#ape").val($(this).attr('data-ape'));
        $("#tele").val($(this).attr('data-tele'));
        $("#numcon").val($(this).attr('data-numcon'));
        $("#nome").focus();
    });

    // Clic del icono eliminar del DataTable
    $(document).on("click", '.delete', function(){
        var id = $(this).attr('data-id');




    });
} // Fin del init

// Código de la validación del formulario modal
function validateForm(){
    $('#formulario').validate({
        rules:{
            nome:{required:true, minlength:4, maxlength:40},
            ape:{required:true, minlength:4, maxlength:60},
            tele:{required:true, minlength:3, maxlength:22},
            numcon:{required:true, minlength:8, maxlength:9},
        },
        messages: {
            nome:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 40 caracteres"},
            ape:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            tele:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 22 caracteres"},
            numcon:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 22 caracteres"},
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
    var parametros = $("#formulario").serialize();
    alert(parametros);
}
