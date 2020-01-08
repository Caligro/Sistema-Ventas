
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
var cboMarca=document.getElementById('cboMarca');
var txtDescripcion= document.getElementById('txtDescripcion');
var txtStock= document.getElementById('txtStock');
var txtUnidadMedida= document.getElementById('txtUnidadMedida');
var txtPrecioVenta= document.getElementById('txtPrecioVenta');
var txtPrecioCosto= document.getElementById('txtPrecioCosto');
var btnGuardar = document.getElementById('btnRegistrar');
var btnCancelar = document.getElementById('btnCancelar');
var btnEditar=document.getElementById('btnEditar');


var idProducto;

//funciones



function cargarDatosEditar(id,idMarca,producto,stock,um,precioVenta,precioCosto){
    $('.select2').data('select2').destroy();
	idProducto = id;
	cboMarca.value=idMarca;
    txtDescripcion.value=producto;
    txtStock.value=stock;
	txtUnidadMedida.value=um;
	txtPrecioCosto.value=precioCosto;
	txtPrecioVenta.value=precioVenta;
    $('.select2').select2();
	$(".collapse").collapse('show');
	btnEditar.style.display = 'inline-block';
	btnCancelar.style.display = 'inline-block';
	btnGuardar.style.display='none';
		$('html,body').animate({
			scrollTop: $("#scrollToHere").offset().top
		}, 600);
	
	 
}

function listarProducto(){	

	var param_opcion = 'listarProducto';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/almacen/cProducto.php',
        success: function(data){
			$('#datatable-Producto').DataTable().destroy();
			$('#bodytable-Producto').html(data);    
			$("#datatable-Producto").DataTable({
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
        var param_idMarca=cboMarca.value;
        var param_descripcion=txtDescripcion.value;
        var param_stock=txtStock.value;
		var param_uniMedida=txtUnidadMedida.value;
		var param_PrecioCosto=txtPrecioCosto.value;
        var param_PrecioVenta=txtPrecioVenta.value;
		if (param_descripcion!="" & param_idMarca!='0' & param_stock!='' & param_uniMedida!="" &
		param_PrecioCosto!=''&param_PrecioVenta!=''){
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                      '&param_idMarca=' + param_idMarca+
                      '&param_descripcion=' + param_descripcion+
					  '&param_stock=' + param_stock+
					  '&param_PrecioCosto=' + param_PrecioCosto+
                      '&param_PrecioVenta=' + param_PrecioVenta+
                      '&param_uniMedida=' + param_uniMedida,
			url: '../../controlador/almacen/cProducto.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarProducto();
				if(obj == 1){	
					alert('Producto registrada con exito.');		
					$('.select2').data('select2').destroy();
	                idProducto = 0;
                    txtDescripcion.value="";	
                    cboMarca.value=0;
                    txtStock.value="";
					txtUnidadMedida.value="";
					txtPrecioCosto.value="";
					txtPrecioVenta.value="";
                    $('.select2').select2();
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
        var param_idProducto=idProducto;
        var param_idMarca=cboMarca.value;
        var param_descripcion=txtDescripcion.value;
        var param_stock=txtStock.value;
        var param_uniMedida=txtUnidadMedida.value;
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                    '&param_idProducto=' + param_idProducto + 
                    '&param_idMarca=' + param_idMarca + 
                    '&param_descripcion=' + param_descripcion + 
                    '&param_stock=' + param_stock + 
				  	'&param_uniMedida=' + param_uniMedida,
			url: '../../controlador/almacen/cProducto.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarProducto();
				if(obj == 1){	
                    alert('Producto editada con exito.');
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
	idProducto = id;
	var param_opcion = 'eliminar';	
	var param_idProducto= idProducto;	
	$.ajax({
		type: 'POST',
		data: 	'param_opcion=' + param_opcion +
				'&param_idProducto=' + param_idProducto,
		url: '../../controlador/almacen/cProducto.php',
		success: function(data){
			console.log(data);
			var obj=JSON.parse(data);
			listarProducto();
			if(obj == 1){	
                cancelar();	
                alert('Producto eliminada con exito.');	
                
				
			}
			else if (obj == 0){
				alert('Error al eliminar.');	
			}
		},
		error:function(data){
			alert('Error al eliminar');
		}
	}); 
}


function cancelar(){
    $('.select2').data('select2').destroy();
	idProducto = 0;
    txtDescripcion.value="";	
    cboMarca.value=0;
    txtStock.value="";
	txtUnidadMedida.value="";
	txtPrecioCosto.value="";
	txtPrecioVenta.value="";
    $('.select2').select2();
	btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnGuardar.style.display='inline-block';
}

function llenarcboMarca(){
    
	var param_opcion = 'llenarcboMarca';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/almacen/cProducto.php',
        success: function(data){
            $('#cboMarca').html(data); 
             $('.select2').select2(); 
             
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
	}


function alCargarDocumento(){
   
	$('#datatable-Producto').DataTable();
   listarProducto(); 
   llenarcboMarca();
    btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnCancelar.addEventListener("click", cancelar);
	btnGuardar.addEventListener("click", guardar);
	btnEditar.addEventListener("click",editar);
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);