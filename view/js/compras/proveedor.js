
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

var txtRazonSocial= document.getElementById('txtRazonSocial');
var txtRuc= document.getElementById('txtRuc');
var btnGuardar = document.getElementById('btnRegistrar');
var btnCancelar = document.getElementById('btnCancelar');
var btnEditar=document.getElementById('btnEditar');

var idProveedor;
var banderaRegistrarEditar;

//funciones



function cargarDatosEditar(id,razSocial,RUC){
	banderaRegistrarEditar=0;
	idProveedor = id;
    txtRazonSocial.value=razSocial;	
    txtRuc.value=RUC;
	$(".collapse").collapse('show');
	btnEditar.style.display = 'inline-block';
	btnCancelar.style.display = 'inline-block';
	btnGuardar.style.display='none';
		$('html,body').animate({
			scrollTop: $("#scrollToHere").offset().top
		}, 600);
	
	 
}

function listarProveedor(){	

	var param_opcion = 'listarProveedor';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/compras/cProveedor.php',
        success: function(data){
			$('#datatable-Proveedor').DataTable().destroy();
			$('#bodytable-Proveedor').html(data);    
			$("#datatable-Proveedor").DataTable({
				"language": idioma_espanol
			});
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
}

function guardar(){	
    
        var param_opcion = 'insert';
        var param_razonSocial=txtRazonSocial.value;
        var param_ruc=txtRuc.value;
		if (param_razonSocial!="" & param_ruc!=""){
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                      '&param_razonSocial=' + param_razonSocial+
                      '&param_ruc=' + param_ruc,
			url: '../../controlador/compras/cProveedor.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarProveedor();
				if(obj == 1){	
					alert('Proveedor registrada con exito.');		
                    txtRazonSocial.value='';
                    txtRuc.value='';
				}
				else if (obj == 0){
					alert('Error al registrar.');	
				}
			},
			error:function(data){
				alert('Error al registrar');
			}
		});}else{
			alert('Llenar campos');
			
		}
		
}

function editar(){	
  
        var param_opcion = 'editar';
		var param_idProveedor= idProveedor;
        var param_razonSocial=txtRazonSocial.value;
        var param_ruc=txtRuc.value;
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
					'&param_idProveedor=' + param_idProveedor + 
                    '&param_razonSocial=' + param_razonSocial+
                    '&param_ruc=' + param_ruc,
			url: '../../controlador/compras/cProveedor.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarProveedor();
				if(obj == 1){	
					alert('Proveedor editada con exito.');	
					cancelar();		
					
				}
				else if (obj == 0){
					alert('Error al editar.');	
				}
			},
			error:function(data){
				alert('Error al editar');
			}
		});
}

function eliminar(id){
	idProveedor = id;
	var param_opcion = 'eliminar';	
	var param_idProveedor= idProveedor;	
	$.ajax({
		type: 'POST',
		data: 	'param_opcion=' + param_opcion +
				'&param_idProveedor=' + param_idProveedor,
		url: '../../controlador/compras/cProveedor.php',
		success: function(data){
			console.log(data);
			var obj=JSON.parse(data);
			listarProveedor();
			if(obj == 1){	
				cancelar();	
				alert('Proveedor eliminada con exito.');		
				
			}
			else if (obj == 0){
				alert('Se encontraron productos activos con esta Proveedor.');	
			}
		},
		error:function(data){
			alert('Error al eliminar');
		}
	}); 
}


function cancelar(){
	banderaRegistrarEditar=1;
	idProveedor = 0;
    txtRazonSocial.value="";
    txtRuc.value=""	
	btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnGuardar.style.display='inline-block';
	$(".collapse2").collapse('hide');
}




function alCargarDocumento(){
	$('#datatable-Proveedor').DataTable();
   listarProveedor(); 
    btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnCancelar.addEventListener("click", cancelar);
	btnGuardar.addEventListener("click", guardar);
	btnEditar.addEventListener("click",editar);
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);