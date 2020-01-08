
//var a espanish datatable
var idioma_espanol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}


//VARIABLES 


var fechaInicial=document.getElementById('fechaInicial');
var fechaFinal=document.getElementById('fechaFinal');
var btnBuscar=document.getElementById('btnBuscar');
var cboTipo=document.getElementById('cboTipo');
//funciones


function mostrarDetalle(idDocumento){	

	var param_opcion = 'mostrarDetalle';
	var param_idDocumento=idDocumento;
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion+
         '&param_idDocumento=' + param_idDocumento,
        url: '../../controlador/listar/cListarVC.php',
        success: function(data){
            console.log(data);
            $('#datatable-DVC').DataTable().destroy();
			$('#bodytable-DVC').html(data);    
			$("#datatable-DVC").DataTable({
				"language": idioma_espanol
			});
			
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
}

function listarVC(){
    var param_opcion = 'listarVC';
    var param_Tipo=cboTipo.value;
    var param_fechaInicial=fechaInicial.value;
    var param_fechaFinal=fechaFinal.value;
    if(param_Tipo!='2'){
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion+
        '&param_Tipo=' + param_Tipo+
        '&param_fechaInicial=' + param_fechaInicial+
        '&param_fechaFinal=' + param_fechaFinal,
        url: '../../controlador/listar/cListarVC.php',
        success: function(data){
            console.log(data);
            $('#datatable-VC').DataTable().destroy();
			$('#bodytable-VC').html(data);    
			$("#datatable-VC").DataTable({
				"language": idioma_espanol
			});
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });}else{
        alert("No selecciono tipo Movimiento");
    }
}





function alCargarDocumento(){
    $('#datatable-VC').DataTable();
    $('#datatable-DVC').DataTable();
	btnBuscar.addEventListener("click", listarVC);

}
//EVENTOS
window.addEventListener("load", alCargarDocumento);