
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
var btnImprimir=document.getElementById('btnImprimir');
var btnBuscar=document.getElementById('btnBuscar');
var cboProducto=document.getElementById('cboProducto');

//funciones



function obtenerDatosxProducto(){
    var param_opcion = 'obtenerDatosxProducto';
    var param_idProducto=cboProducto.value;
    var param_fechaInicial=fechaInicial.value;
    var param_fechaFinal=fechaFinal.value;
    if(param_idProducto!='0'){
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion+
        '&param_idProducto=' + param_idProducto+
        '&param_fechaInicial=' + param_fechaInicial+
        '&param_fechaFinal=' + param_fechaFinal,
        url: '../../controlador/kardex/cKardex.php',
        success: function(data){
            
            $('#datatable-Kardex').DataTable().destroy();
			$('#bodytable-Kardex').html(data);    
			$("#datatable-Kardex").DataTable({
				"language": idioma_espanol
			});
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });}else{
        alert("No selecciono un producto");
    }
}
function llenarcboProducto(){
      
	var param_opcion = 'llenarcboProducto';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/ventas/cVentaCliente.php',
        success: function(data){
            $('#cboProducto').html(data); 
             $('.select2').select2(); 
             
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
}

function imprimir(){
    var param_opcion = 'imprimir';
    var param_idProducto=cboProducto.value;
    var param_fechaInicial=fechaInicial.value;
    var param_fechaFinal=fechaFinal.value;
    if(param_idProducto!='0'){
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion+
        '&param_idProducto=' + param_idProducto+
        '&param_fechaInicial=' + param_fechaInicial+
        '&param_fechaFinal=' + param_fechaFinal,
        url: '../../controlador/kardex/cKardex.php',
        success: function(data){
            var obj =JSON.parse(data);
            console.log(obj);
            if (obj.length>0){
                generaReporte(param_fechaInicial,param_fechaFinal,obj,param_idProducto);
            }else
            {alert('No hay datos para el reporte');}
            
           
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });}else{
        alert("No selecciono un producto");
    }
}



function generaReporte(fechainicial,fechafinal,objeto,idProducto){


    var doc = new jsPDF () ;
    doc.setFontSize(12);
    doc.text( 20, 20,'REPORTE DE MOVIMIENTOS - KARDEX') ;
    doc.setFontSize(11);
    doc.text( 20, 30,'Fecha Inicial: ') ;
    doc.text(45,30,fechainicial)
    doc.text(20, 35,'Fecha Final: ') ;
    doc.text(44,35,fechafinal)

    doc.rect(20, 40, 10, 7);
    doc.text(22, 45,'Nº');
    doc.rect(30, 40, 40, 7);
    doc.text(32, 45,'Producto');
    doc.rect(70, 40, 35, 7);
    doc.text(72, 45,'Tipo Movimiento');
    doc.rect(105, 40, 50, 7);
    doc.text(107, 45,'Fecha Movimiento');
    doc.rect(155, 40, 20, 7);
    doc.text(157, 45,'Cantidad');
    doc.rect(175, 40, 16, 7);
    doc.text(177, 45,'Stock');
    var cont=0;
    objeto.forEach(function(e,index){   
		cont=cont+7;
	doc.rect(20, 40+cont, 10, 7);
    doc.text(22, 45+cont,e.cont);
    doc.rect(30, 40+cont, 40, 7);
    doc.text(32, 45+cont,e.producto);
    doc.rect(70, 40+cont, 35, 7);
    doc.text(72, 45+cont,e.tipoMov);
    doc.rect(105, 40+cont, 50, 7);
    doc.text(107, 45+cont,e.fecha);
    doc.rect(155, 40+cont, 20, 7);
    doc.text(157, 45+cont,e.cantidad);
    doc.rect(175, 40+cont, 16, 7);
    doc.text(177, 45+cont,e.stock);
		
	
	});

  

    doc.save ( 'reporte-'+ hoyFecha()+idProducto+'.pdf');
			
}


function hoyFecha(){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
		mm = addZero(mm);
		var fecha;
		
			fecha=yyyy+'-'+mm+'-'+dd;
		
		
        return fecha;
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}



function alCargarDocumento(){
    $('#datatable-Kardex').DataTable();
    llenarcboProducto();
	btnBuscar.addEventListener("click", obtenerDatosxProducto);
    btnImprimir.addEventListener("click",imprimir);
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);