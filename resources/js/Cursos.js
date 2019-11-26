$(init);
var table = null;
var cursos = null;

function init(){
    // Inicializa el NavBar
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });

    // Configuración del DataTable
    table = $('#cur').DataTable({"aLengthMenu": 
           [[10,25,50,75,100],[10,25,50,75,100]],
           "iDisplaylength":15});

    //Llena el arrelo de cursos con la Información BD
    cargaCursos();      
    
    //Iniciliza la ventana Modal y la Validación
    $("#modalRegistro").modal();
    validateForm();

    // Clic del boton circular Agregar
    $("#add-record").on("click",function(){
        $("#pk").val('0');
        $("#tit").val('');
        $("#descrip").val('');
        $("#costo").val('0');
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    });
    
// Clic del boton circular Imprimir
    $("#print-record").on("click",function(){
        document.location.href = "http://localhost/AProyectoX/TCPDF/Reportes/Reporte3.php"
    });

    // clic del boton de guardar
    $('#guardar').on("click",function(){
        $('#frm-cursos').submit();
    });

    // clic de Borrar
    $(document).on("click", '.delete', function(){
        var id = $(this).attr("id-record");
        deleteData(id);
    });

    // clic de Editar
    $(document).on("click", '.edit', function(){
        //alert("editando");
        var id = $(this).attr("id-record");
        $("#tit").val(cursos[id]["titcurso"]).next().addClass('active');
        $("#descrip").val(cursos[id]["descripcurso"]).next().addClass('active');
        $("#costo").val(cursos[id]["costo"]).next().addClass('active');
        $("#imagen").val(cursos[id]["imagen"]).next().addClass('active');
        $("#idtip").val(cursos[id]["idtipo"]).next().addClass('active');
    
        $("#pk").val(id);
        $("#modalRegistro").modal('open');
        $("#tit").focus();
    });

       
}

function validateForm(){
    $('#frm-cursos').validate({
        rules: {
            tit:{required:true,minlength:8, maxlength:60},
            descrip:{required:true, minlength:8, maxlength:126},
            costo:{required:true, number:true},         
        },
        messages: {
            tit:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 8 caracteres", maxlength:"No puedes ingresar más de 60 caracteres"},
            descrip:{required:"No puedes dejar este campo vacío",minlength:"Debes ingresar al menos 8 caracteres", maxlength:"No puedes ingresar más de 126 caracteres"},
            costo:{required:"Debes ingresar un costo válido",number:"Este campo debe ser numérico"},             
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

function cargaCursos(){
    var parametros = "";
    $.ajax({
        type:"post",
        url:"llenaArrayCursos.php",
        dataType:'json',
        data:parametros,
        success:function(respuesta){
            if (respuesta['status']){
                cursos=respuesta['data'];
            } else{
                cursos=null;
            }
        }
    });
}

function saveData(){
    var id = $("#pk").val(); 
    var boton = "";
    var sURL = "";
    var parametros = "";

    if (id == "0")
    {
        sURL="actCursoAgregar.php";
    }else{
        sURL = "actCursoActualizar.php";
    }
    
    parametros = new FormData($("#frm-cursos")[0]);
 //   alert(parametros);
    //var parametros='pk='+ id + "&tit=" + $("#tit").val() +
    //               "&descrip=" + $("#descrip").val() + 
    //               "&costo=" + $("#costo").val()+ boton;
    
    $.ajax({
        type:"post",
        url:sURL,
        contentType: false,
        processData:false,
        dataType:'json',
        data: parametros,
        success: function(respuesta){
            alert(respuesta['status']);
            if (respuesta['status']){
                var nomtip = $('select[name="idtip"] option:selected').text();
                $("#pk").val('0');
                $("#tit").val('');
                $("#descrip").val('');
                $("#costo").val('0');
                $("#modalRegistro").modal('close');
                M.toast({html: 'Curso Guardado', classes: 'rounded', displayLength: 4000});
                //$("#tabla").load("CargaCursos.php");
                if (id == "0"){ // Insert
                    actualizaDataTable(respuesta['data'],'insert',nomtip)
                }
                else // Update
                {
                    actualizaDataTable(respuesta['data'],'delete')
                    actualizaDataTable(respuesta['data'],'insert',nomtip)
                }
            }
            else{
                M.toast({html: 'Error al Agregar Curso', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}

function deleteData(id){
    var boton = "&boton=Borrar";
    var parametros='pk='+ id + boton;
    $.ajax({
        type:"post",
        url:"actCursoEliminar.php",
        dataType:'json',
        data:parametros,
        success: function(respuesta){
            if (respuesta['status']){
                M.toast({html: 'Curso Eliminado', classes: 'rounded', displayLength: 4000});
                actualizaDataTable(respuesta['data'],'delete');
            }
            else{
                M.toast({html: 'Error al Eliminar Curso', classes: 'rounded', displayLength: 4000});
            }
        }
    });
}
|
function actualizaDataTable(data, action, nomtip) {
    if (action === 'insert'){
        var row = table.row.add([
            data.tit,
            data.descrip,
            data.costo,
            data.imagen,
            nomtip,
            '<i class="material-icons edit" id-record="' + data.pk + '">create</i>' +
            '<i class="material-icons delete" id-record="' + data.pk +  '">delete_forever</i>'
        ]).draw().node();
        $(row).attr('id',data.pk);
        //Agrega el registro al arreglo cursos
        cursos[data.pk]={
            "idcurso":      data.pk,
            "titcurso":     data.tit,
            "descripcurso": data.descrip,
            "costo":        data.costo,
            "imagen":       data.imagen,
            "idtipo":       data.idtipo,
        }
    } 
    else if (action === 'delete'){
        table.row('#'+ data.pk).remove().draw();   
    }
}

