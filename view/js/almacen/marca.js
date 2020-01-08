
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

var txtDescripcion= document.getElementById('txtDescripcion');
var btnGuardar = document.getElementById('btnRegistrar');
var btnCancelar = document.getElementById('btnCancelar');
var btnEditar=document.getElementById('btnEditar');

var idMarca;
var banderaRegistrarEditar;

//funciones



function cargarDatosEditar(id,des){
	banderaRegistrarEditar=0;
	idMarca = id;
	txtDescripcion.value=des;	
	$(".collapse").collapse('show');
	btnEditar.style.display = 'inline-block';
	btnCancelar.style.display = 'inline-block';
	btnGuardar.style.display='none';
		$('html,body').animate({
			scrollTop: $("#scrollToHere").offset().top
		}, 600);
	
	 
}

function listarMarca(){	

	var param_opcion = 'listarMarca';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/almacen/cMarca.php',
        success: function(data){
			$('#datatable-marca').DataTable().destroy();
			$('#bodytable-marca').html(data);    
			$("#datatable-marca").DataTable({
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
		var param_descripcion=txtDescripcion.value;
		if (param_descripcion!=""){
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
				  	'&param_descripcion=' + param_descripcion,
			url: '../../controlador/almacen/cMarca.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarMarca();
				if(obj == 1){	
					alert('Marca registrada con exito.');		
					txtDescripcion.value='';
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
		var param_idMarca= idMarca;
		var param_descripcion=txtDescripcion.value;
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
					'&param_idMarca=' + param_idMarca + 
				  	'&param_descripcion=' + param_descripcion,
			url: '../../controlador/almacen/cMarca.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarMarca();
				if(obj == 1){	
					alert('Marca editada con exito.');	
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
	idMarca = id;
	var param_opcion = 'eliminar';	
	var param_idMarca= idMarca;	
	$.ajax({
		type: 'POST',
		data: 	'param_opcion=' + param_opcion +
				'&param_idMarca=' + param_idMarca,
		url: '../../controlador/almacen/cMarca.php',
		success: function(data){
			console.log(data);
			var obj=JSON.parse(data);
			listarMarca();
			if(obj == 1){	
				cancelar();	
				alert('Marca eliminada con exito.');		
				
			}
			else if (obj == 0){
				alert('Se encontraron productos activos con esta marca.');	
			}
		},
		error:function(data){
			alert('Error al eliminar');
		}
	}); 
}


function cancelar(){
	banderaRegistrarEditar=1;
	idMarca = 0;
	txtDescripcion.value="";	
	btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnGuardar.style.display='inline-block';
}




function alCargarDocumento(){
	$('#datatable-marca').DataTable();
   listarMarca(); 
    btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnCancelar.addEventListener("click", cancelar);
	btnGuardar.addEventListener("click", guardar);
	btnEditar.addEventListener("click",editar);
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);