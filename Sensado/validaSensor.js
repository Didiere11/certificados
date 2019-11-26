$(init);
var tabla = null;

function init(){
    tabla = $("#sensa").DataTable({
        "aLengthMenu":[[10,25,50,75,100],[10,25,50,75,100]],
        "iDisplaylength":15
    });
}