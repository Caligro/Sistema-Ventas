
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
var cboRol=document.getElementById('cboRol');
var txtNombre= document.getElementById('txtNombre');
var cboGenero= document.getElementById('cboGenero');
var txtUsuario= document.getElementById('txtUsuario');
var txtContra= document.getElementById('txtContra');
var txtContraVerifica= document.getElementById('txtContraVerifica');
var btnGuardar = document.getElementById('btnRegistrar');
var btnCancelar = document.getElementById('btnCancelar');
var btnEditar=document.getElementById('btnEditar');


var idUsuario;
var idVendedor;
//funciones



function cargarDatosEditar(idRol,idUsu,idVen,nombre,usuario,genero){
    
    idUsuario = idUsu;
    idVendedor=idVen;
    cboRol.value=idRol;
    txtNombre.value=nombre;
    if(genero=="Masculino"){cboGenero.value=1;} 
    else if(genero=="Femenino"){cboGenero.value=2;}
	txtUsuario.value=usuario;    
	$(".collapse").collapse('show');
	btnEditar.style.display = 'inline-block';
	btnCancelar.style.display = 'inline-block';
	btnGuardar.style.display='none';
		$('html,body').animate({
			scrollTop: $("#scrollToHere").offset().top
		}, 600);
	
	 
}

function listarUsuario(){	

	var param_opcion = 'listarUsuario';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/seguridad/cUsuario.php',
        success: function(data){
			$('#datatable-Usuario').DataTable().destroy();
			$('#bodytable-Usuario').html(data);    
			$("#datatable-Usuario").DataTable({
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
        var param_rol=cboRol.value;
        var param_nombre=txtNombre.value;
        var param_genero;
        if(cboGenero.value=='1'){param_genero="Masculino";} 
        else if(cboGenero.value=='2'){param_genero="Femenino";}
        else{param_genero="0";}
        var param_usuario=txtUsuario.value;
        var param_contra;
        if(txtContra.value!=txtContraVerifica.value){param_contra="0";}
        else if(txtContraVerifica.value==txtContra.value){param_contra=txtContra.value;}

        console.log(param_rol+param_nombre+param_genero,param_usuario,param_contra)
		if (param_rol!='0' & param_nombre!="" & param_genero!='0' & param_usuario!="" & param_contra!="0"){
        
            
            $.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                      '&param_rol=' + param_rol+
                      '&param_nombre=' + param_nombre+
					  '&param_genero=' + param_genero+
					  '&param_usuario=' + param_usuario+
                      '&param_contra=' + param_contra,
            url: '../../controlador/seguridad/cUsuario.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarUsuario();
				if(obj == 1){	
					alert('Usuario registrado con exito.');	
	                idUsuario = 0;
                    idVendedor=0;
                    cboRol.value=0;
                    txtNombre.value="";
                    cboGenero.value=0;
	                txtUsuario.value="";    
                    txtContra.value="";
                    txtContraVerifica.value="";
				}
				else if (obj == 0){
					alert('Error al registrar.');	
				}
			},
			error:function(data){
				alert('Error al registrar');
			}
		});}else{
			alert('Campos no válidos');
			
		}
		
}

function editar(){	
  
    var param_opcion = 'editar';
    var param_rol=cboRol.value;
    var param_nombre=txtNombre.value;
    var param_genero;
    if(cboGenero.value=='1'){param_genero="Masculino";} 
    else if(cboGenero.value=='2'){param_genero="Femenino";}
    else{param_genero="0";}
    var param_usuario=txtUsuario.value;
    if (param_rol!='0' & param_nombre!="" & param_genero!='0' & param_usuario!="" ){
        
		$.ajax({
			type: 'POST',
			data: 	'param_opcion=' + param_opcion +
                    '&param_idUsuario=' + idUsuario + 
                    '&param_idVendedor=' + idVendedor + 
                     '&param_rol=' + param_rol+
                      '&param_nombre=' + param_nombre+
					  '&param_genero=' + param_genero+
					  '&param_usuario=' + param_usuario,
            url: '../../controlador/seguridad/cUsuario.php',
			success: function(data){
				console.log(data);
				var obj=JSON.parse(data);
				listarUsuario();
				if(obj == 1){	
                    alert('Usuario editado con exito.');
                    cancelar();		
					
				}
				else if (obj == 0){
					alert('Error al editar.');	
				}
			},
			error:function(data){
				alert('Error al editar');
			}
		});}else{
            alert('Campos no válidos');
        }
}

function eliminar(idusu,idven){
	var param_opcion = 'eliminar';	
    var param_idUsuario= idusu;	
    var param_idVendedor= idven;	
	$.ajax({
		type: 'POST',
		data: 	'param_opcion=' + param_opcion +
				'&param_idUsuario=' + param_idUsuario+
				'&param_idVendedor=' + param_idVendedor,
        url: '../../controlador/seguridad/cUsuario.php',
		success: function(data){
			console.log(data);
			var obj=JSON.parse(data);
			listarUsuario();
			if(obj == 1){	
                cancelar();	
                alert('Usuario eliminado con exito.');	
                
				
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

    idUsuario = 0;
    idVendedor=0;
    cboRol.value=0;
    txtNombre.value="";
    cboGenero.value=0;
	txtUsuario.value="";    
        
    txtContra.value="";
    txtContraVerifica.value="";
	btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnGuardar.style.display='inline-block';
}

function llenarcboRol(){
    
	var param_opcion = 'llenarcboRol';
	
    $.ajax({
        type: 'POST',
        data: 'param_opcion='+param_opcion, 
        url: '../../controlador/seguridad/cUsuario.php',
        success: function(data){
            $('#cboRol').html(data);              
        },
        error:function(data){
            alert('Error al mostrar');
        }
    });
    }
 

function alCargarDocumento(){
   
	$('#datatable-Usuario').DataTable();
    listarUsuario(); 
   llenarcboRol();
    btnEditar.style.display = 'none';
	btnCancelar.style.display = 'none';
	btnCancelar.addEventListener("click", cancelar);
	btnGuardar.addEventListener("click", guardar);
	btnEditar.addEventListener("click",editar);
}
//EVENTOS
window.addEventListener("load", alCargarDocumento);