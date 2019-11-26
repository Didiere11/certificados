$(init);

function init(){
    validaForm();

    $('#btnGuardar').on("click", function(){
        $('#frm1').submit();
    });
}

function validaForm(){
    $('#frm1').validate({
    rules:{
        corr:{ required:true, minlength:8, maxlength:100, email:true },
        contra:{ required:true, minlength:4, maxlength:32 },
        nom:{ required:true, minlength:4, maxlength:30 },
        apll:{ required:true, minlength:4, maxlength:30 },
        fec:{required:true, date:true},
    },
    messages:{
        corr:{required:'Correo Electronico Requerido', minlength:'Minimo 8 caracteres', maxlength:'Maximo 100 caracteres', email:'Correo Ivalido'},
        contra:{required:'Contraseña Requerida', minlength:'Minimo 4 caracteres', maxlength:'Maximo 32 caracteres'},
        nom:{required:'El Nombre es Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 30 caracteres'},
        apll:{required:'Apellido Requerido', minlength:'Minimo 4 caracteres', maxlength:'Maximo 30 caracteres'},
        fec:{required:'Campo requerido', date:'Se requiere una fecha'},
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
    alert("Formulario Validado");
}
