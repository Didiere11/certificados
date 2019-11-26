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

    $("#print").on("click",function(){
        document.location.href = "http://localhost/pwebe/Reportes/pantallas.php"
    });
    $("#imp").on("click",function(){
      var idcarr = $("#idcarr option:selected").text();
        
        document.location.href = "http://localhost/pwebe/Reportes/pantallas.php"
    });

    $('#add').on("click", function(){
        $('#nocontrol').val('');
        $('#nom').val('');
        $("#appe").val('');
        $("#idsta").val(1);
        $('#idsta').formSelect();
        $("#tel").val('');
        $("#corr").val('');
        $("#idcarr").val(1);
        $('#idcarr').formSelect();
        $("#idingr").val(1);
        $('#idingr').formSelect();
        $('#ventanaModal').modal('open');
        $('#nocontrol').focus();
    });

    $('#guardar').on("click", function(){
        $('#formulario').submit();
    });

    $(document).on("click", '.edit', function(){
        var nocontrol = $(this).attr("data-nocontrol");
        var nom = $(this).attr("data-nom");
        var appe = $(this).attr("data-appe");
        var idsta = $(this).attr("data-stat");
        var corr = $(this).attr("data-corr");
        var idcarr = $(this).attr("data-carr");
        var tel = $(this).attr("data-tel");
        var idingr = $(this).attr("data-ingreso");
        $('#nocontrol').val(nocontrol);
        $('#nom').val(nom);
        $("#appe").val(appe);
        $("#corr").val(corr);
        $("#tel").val(tel);
       // $("#idsta").val(idsta);
        $('#idsta').formSelect();
       // $("#idcarr").val(idcarr);
        $('#idcarr').formSelect();
       // $("#idingr").val(idingr);
        $('#idingr').formSelect();
        $('#ventanaModal').modal('open');
        $('#nocontrol').focus();
    });

    $(document).on("click", '.delete', function(){
        var nocontrol = $(this).attr("data-nocontrol");
        var parametros = "nocontrol=" + nocontrol + "&tabla=reportes&accion=Eliminar";
        $.ajax({
            type: "post",
            url: controlador,
            dataType: 'json',
            data: parametros,
            success: function(respuesta){
                if (respuesta['status']==1){
                    var data = respuesta['data'];
                    if (nocontrol>0){
                        table.row('#' + data.nocontrol).remove().draw();
                    }

                    M.toast({html: 'Reporte eliminado', classes: 'rounded blue lighten-2'});
                }
            } 
        });
    });
}

function validateForm(){
    $('#formulario').validate({
        rules:{
            nocontrol:{required:true, minlength:8, maxlength:8,digits:true},
            nom:{required:true, minlength:4, maxlength:40},
            appe:{required:true, minlength:4, maxlength:60},
            //stat:{required:true, },
            corr:{required:true, minlength:4, maxlength:60},
            tel:{required:true, digits:true},
        },
        messages: {
            nocontrol:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 100 caracteres",digits:"Solo numeros"},
            nom:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 40 caracteres"},
            appe:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
           // stat:{required:"No puedes dejar este campo vacío",},
            corr:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 4 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            tel:{required:"No puedes dejar este campo vacío", digits:"Solo numeros"},
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
    var idsta = $("#idsta option:selected").text();
    var idcarr = $("#idcarr option:selected").text();
    var nocontrol = $("#nocontrol").val();  
    var parametros = $("#formulario").serialize() +"&tabla=Reportes"
        parametros = parametros + "&accion=Guardar";
    $.ajax({
        type: "post",
        url: controlador,
        dataType: 'json',
        data: parametros,
        success: function(respuesta){
            if (respuesta['status']==1){
                $('#nocontrol').val('');
                $('#nom').val('');
                $("#appe").val('');
                $("#corr").val('');
                $("#tel").val('');
                $("#idsta").val(1);
                $('#idsta').formSelect();
                $("#idcarr").val(1);
                $('#idcarr').formSelect();
                $("#idingr").val(1);
                $('#idingr').formSelect();
                $('#ventanaModal').modal('close');
                var data = respuesta['data'];
                if (nocontrol >0){
                    table.row('#' + data.nocontrol).remove().draw();
                }
                var row = table.row.add([
                    data.nocontrol,
                    data.nom,
                    data.appe,
                    idsta,
                    data.tel,
                    data.corr,
                    idcarr,
                    idingr,
                    '<i class="material-icons edit" data-nocontrol="' + data.nocontrol + '" data-nom="' + data.nom +'" data-appe="' + data.appe +'" data-stat="' + idsta +'"data-corr="' + data.corr +'"data-tel="' + data.tel +'" data-idcarr="' + idcarr+' " data-idingr="' + idingr+'">create</i><i class="material-icons delete" data-nocontrol="' + data.nocontrol + '">delete_forever</i>'
                ]).draw().node();
                $(row).attr('id',data.nocontrol);

                M.toast({html: 'Reporte guardado', classes: 'rounded'});
            }
        } 
    });
}
