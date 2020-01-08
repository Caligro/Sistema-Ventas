

//VARIABLES 
var cboCliente=document.getElementById('cboCliente');
var cboTipoDoc=document.getElementById('cboTipoDoc');
var fechaVenta=document.getElementById('fechaVenta');

var cboProducto=document.getElementById('cboProducto');

var txtPrecio=document.getElementById('txtPrecio');
var txtStock=document.getElementById('txtStock');
var txtCantidad=document.getElementById('txtCantidad');


var btnAgregar = document.getElementById('btnAgregar');
var btnRealizarVenta = document.getElementById('btnRealizarVenta');
var btnCancelar = document.getElementById('btnCancelar');

var txtTotalPago=document.getElementById('txtTotalPago');


var objProducto=[];
var detalleProducto=[];
var index=0;


//funciones


function cancelar(){
	$('.select2').data('select2').destroy();
	cboCliente.value=0;
	cboTipoDoc.value=0;
	fechaVenta.value= hoyFecha(2);
	cboProducto.value=0;
	$('.select2').select2();
	txtCantidad.value="";
	txtPrecio.value="";
	txtStock.value="";
	txtTotalPago.value="";
	detalleProducto.forEach(function(e,index){  			
		detalleProducto[index] = "";
	});
	index=0;
	llenarListaDetalleProducto();
}



function llenarcboCliente(){
      
	var param_opcion = 'llenarcboProveedor';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/ventas/cVentaCliente.php',
        success: function(data){
            $('#cboCliente').html(data); 
             $('.select2').select2(); 
             
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
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

function cargarDatosProd(idProducto){
	var param_opcion = 'cargarDatosProd';
	var param_idProducto=idProducto;
    $.ajax({
        type: 'POST',
		data: 'param_opcion='+param_opcion+
			 '&param_idProducto='+param_idProducto,
        url: '../../controlador/ventas/cVentaCliente.php',
        success: function(data){
			objProducto=JSON.parse(data);
			txtPrecio.value=objProducto.precio;
			txtStock.value=objProducto.stock;
             
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
}

function agregar(){
	var banderaidProducto;
	banderaidProducto=0;
	detalleProducto.forEach(function(e,index){   
		if (e.marca!=null) {
			if(objProducto.idProducto==e.idProducto){
				banderaidProducto=1;
			}
			
		}
	});
	
	if( txtCantidad.value>'0'){
	if(banderaidProducto==0){
	if(txtCantidad.value!="" & txtPrecio.value!="" & objProducto.idProducto!=null  ){
		
	var objTemporal = {
		marca: objProducto.marca,
		idProducto: objProducto.idProducto,
		producto: objProducto.producto,
		cantidad:txtCantidad.value,
		precio:Math.round(txtPrecio.value* 100) / 100 
	  };
	detalleProducto[index]=objTemporal;
	index++;
	llenarListaDetalleProducto();
	}else{
		alert('Falta llenar campos.');
	}
}
else{
	alert('Producto repetido.');
}}
else{
	alert('Stock no válido');
}
	
}
function llenarListaDetalleProducto(){
	$("#tabla-detalle").html("");
	var cont=0;
	var sumaTotal=0;
	
	detalleProducto.forEach(function(e,index){   
		if (e.marca!=null) {
			sumaTotal=sumaTotal+(e.cantidad*e.precio);
		cont++;
		var tr = `<tr>
		<td>`+cont+`</td>
          <td>`+e.marca+`</td>
          <td>`+e.producto+`</td>
          <td>`+e.cantidad+`</td>
		  <td>`+e.precio+`</td>
		  <td><button class="btn btn-xs btn-danger" onclick="eliminarProdDetalle(`+index+`)">Eliminar</button></td>
        </tr>`;
		$("#tabla-detalle").append(tr);
		txtTotalPago.value=Math.round(sumaTotal* 100) / 100 ;
		}
	
	});
}

function eliminarProdDetalle(index){
	detalleProducto[index] = "";
	llenarListaDetalleProducto();
}

function realizarVenta(){
	var param_opcion='insertarCompra';
	var param_fecha=fechaVenta.value;
	var param_idCliente=cboCliente.value;
	var param_TipoDoc=cboTipoDoc.value;
	var banderaDetalleObj;
	banderaDetalleObj=0;
	detalleProducto.forEach(function(e,index){  
		if(detalleProducto[index] != ""){
			banderaDetalleObj=1;
		}
	});
	console.log(detalleProducto);
	if (param_fecha==hoyFecha(1) & param_idCliente!='0' & banderaDetalleObj==1){
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                      '&param_fecha=' + param_fecha+
					  '&param_idCliente=' + param_idCliente+
					  '&param_TipoDoc=' + param_TipoDoc,
			url: '../../controlador/ventas/cVentaCliente.php',
			success: function(data){
				var idDocumento=JSON.parse(data);
				var param_idDocumento=idDocumento;
				detalleProducto.forEach(function(e,index){   
					if (e.marca!=null) {
						console.log(e.idProducto+'|'+param_idDocumento+'|'+e.cantidad+'|'+e.precio+'|'+param_TipoDoc)
						$.ajax({
							type: 'POST',
							data: 	'param_opcion=' + 'insertarDetalleCompra' +
									  '&param_idProducto=' + e.idProducto+	
									  '&param_idDocumento=' + param_idDocumento+
									  '&param_cantidad=' + e.cantidad+
									  '&param_precio=' + e.precio+
									  '&param_TipoDoc=' + param_TipoDoc,
							url: '../../controlador/ventas/cVentaCliente.php',
							success: function(data){
								console.log(data);
								var obj=JSON.parse(data);
								if(obj != 0){	
										
								}
								else if (obj == 0){
								alert('Error al insertar detalle (Consulte a su proveedor para mas información).');	
								}
								
							},
							error:function(data){
								alert('Error al registrar');
							}
						});		
					}
				
				});
				alert('Compra realizada.');	
				cancelar();			
			},
			error:function(data){
				alert('Error al registrar');
			}
		});}
	else{
		alert("Campos no válidos o no se seleccionaron productos");}

}

function hoyFecha(formatoID){
    var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth()+1;
        var yyyy = hoy.getFullYear();
        
        dd = addZero(dd);
		mm = addZero(mm);
		var fecha;
		if (formatoID==1){
			fecha=yyyy+'-'+mm+'-'+dd;
		}else{
			fecha=yyyy+'-'+mm+'-'+dd;
		}
		
        return fecha;
}

function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}



function alCargarDocumento(){
   //listarCliente(); 

   llenarcboCliente();
   llenarcboProducto();
   btnAgregar.addEventListener("click",agregar);
   btnRealizarVenta.addEventListener("click",realizarVenta);
   btnCancelar.addEventListener("click", cancelar);

	/*
	btnGuardar.addEventListener("click", guardar);
	btnEditar.addEventListener("click",editar);*/
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);



