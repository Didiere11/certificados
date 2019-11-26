$(init);
var table = null;
var controlador = "../Utilerias/Controlador.php";

function init(){
    table = $('#dtTable').DataTable({
        "aLengthMenu" : [[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplayLength" : 15
    });
    $('#ventanaModal').modal();
    validateForm();

    $('#add').on("click", function(){
        $('#idpadre').val('');
        $('#nom').val('');
        $("#corr").val('');
        $("#parent").val('');
        $("#dom").val('');
        $('#ventanaModal').modal('open');
        $('#nom').focus();
    });

    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){
        var idpadre = $(this).attr("data-idpadre");
        var nom = $(this).attr("data-nom");
        var corr = $(this).attr("data-corr");
        var parent = $(this).attr("data-parent");
        var dom = $(this).attr("data-dom");
        var tel = $(this).attr("data-tel");
        $('#idpadre').val(idpadre);
        $('#nom').val(nom);
        $("#corr").val(corr);
        $("#parent").val(parent);
        $("#dom").val(dom);
        $("#tel").val(tel);
        $('#ventanaModal').modal('open');
        $('#nom').focus();
    });

    $(document).on("click", '.delete', function(){
        var idpadre = $(this).attr("data-idpadre");
        var parametros = "idpadre=" + idpadre + "&tabla=padretutor&accion=Eliminar";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (idpadre>0){
                        table.row('#' + data.idpadre).remove().draw();
                    }

                    M.toast({html: 'padre o tutor eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){
    $('#formulario').validate({
        rules:{
            nom:{required:true, minlength:4, maxlength:100},
            parent:{required:true, minlength:4, maxlength:40},
            tel:{required:true, digits:true},
        },
        messages: {
            nom:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres"},
            parent:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 40 caracteres"},
            tel:{required:"No puedes dejar este campo vacío", digits:"Solo numeros"}
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

function saveData(){
    var idpadre = $("#idpadre").val();  
    var parametros = $("#formulario").serialize() +"&tabla=padretutor"
    if (idpadre > 0){
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
                $('#idpadre').val('');
                $('#nom').val('');
                $("#corr").val('');
                $("#parent").val('');
                $("#dom").val('');
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (idpadre >0){
                    table.row('#' + data.idpadre).remove().draw();
                }
                var row = table.row.add([
                    data.nom,
                    data.corr,
                    data.parent,
                    data.tel,
                    '<i class="material-icons edit" data-idpadre="' + data.idpadre + '" data-nom="' + data.nom +'" data-corr="' + data.corr +'" data-parent="' + data.parent +'"data-dom="' + data.dom +'"data-tel="' + data.tel +'">create</i><i class="material-icons delete" data-idpadre="' + data.idpadre + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.idpadre);

                M.toast({html: 'Padre o tutor guardado', classes: 'rounded'});
            }
        } 
    });
}
