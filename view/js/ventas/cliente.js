
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

var txtNombre= document.getElementById('txtNombre');
var txtDireccion= document.getElementById('txtDireccion');
var txtEmail= document.getElementById('txtEmail');
var txtFono= document.getElementById('txtFono');


var btnGuardar = document.getElementById('btnRegistrar');
var btnCancelar = document.getElementById('btnCancelar');
var btnEditar=document.getElementById('btnEditar');

var idCliente;

//funciones



function cargarDatosEditar(id,nombre,direccion,email,fono){
	idCliente = id;
    txtNombre.value=nombre;	
	txtDireccion.value=direccion;
	txtEmail.value=email;	
    txtFono.value=fono;
	$(".collapse").collapse('show');
	btnEditar.style.display = 'inline-block';
	btnCancelar.style.display = 'inline-block';
	btnGuardar.style.display='none';
		$('html,body').animate({
			scrollTop: $("#scrollToHere").offset().top
		}, 600);
	
	 
}

function listarCliente(){	

	var param_opcion = 'listarCliente';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/ventas/cCliente.php',
        success: function(data){
			$('#datatable-Cliente').DataTable().destroy();
			$('#bodytable-Cliente').html(data);    
			$("#datatable-Cliente").DataTable({
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
        var param_nombre=txtNombre.value;
		var param_direccion=txtDireccion.value;
		var param_email=txtEmail.value;
		var param_fono=txtFono.value;
		
		if (param_nombre!="" & param_direccion!="" & param_email!="" & param_fono!=""){
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                      '&param_nombre=' + param_nombre+
					  '&param_direccion=' + param_direccion+
					  '&param_email=' + param_email+
                      '&param_fono=' + param_fono,
			url: '../../controlador/ventas/cCliente.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarCliente();
				if(obj == 1){	
					alert('Cliente registrada con exito.');		
					txtNombre.value="";
					txtDireccion.value=""	
					txtEmail.value="";
					txtFono.value="";
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
		var param_idCliente= idCliente;
		var param_nombre=txtNombre.value;
		var param_direccion=txtDireccion.value;
		var param_email=txtEmail.value;
		var param_fono=txtFono.value;
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
					'&param_idCliente=' + param_idCliente + 
                    '&param_nombre=' + param_nombre+
					  '&param_direccion=' + param_direccion+
					  '&param_email=' + param_email+
                      '&param_fono=' + param_fono,
			url: '../../controlador/ventas/cCliente.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarCliente();
				if(obj == 1){	
					alert('Cliente editada con exito.');	
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
	idCliente = id;
	var param_opcion = 'eliminar';	
	var param_idCliente= idCliente;	
	$.ajax({
		type: 'POST',
		data: 	'param_opcion=' + param_opcion +
				'&param_idCliente=' + param_idCliente,
		url: '../../controlador/ventas/cCliente.php',
		success: function(data){
			console.log(data);
			var obj=JSON.parse(data);
			listarCliente();
			if(obj == 1){	
				cancelar();	
				alert('Cliente eliminada con exito.');		
				
			}
			else if (obj == 0){
				alert('Se encontraron productos activos con esta Cliente.');	
			}
		},
		error:function(data){
			alert('Error al eliminar');
		}
	}); 
}


function cancelar(){
	idCliente = 0;
    txtNombre.value="";
	txtDireccion.value=""	
	txtEmail.value="";
    txtFono.value="";	
	btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnGuardar.style.display='inline-block';
}




function alCargarDocumento(){
	$('#datatable-Cliente').DataTable();
   listarCliente(); 
    btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnCancelar.addEventListener("click", cancelar);
	btnGuardar.addEventListener("click", guardar);
	btnEditar.addEventListener("click",editar);
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);