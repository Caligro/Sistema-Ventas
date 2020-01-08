<?php 

	include_once '../../modelo/ventas/mVentaCliente.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_fecha'] = '';	
	$param['param_idCliente'] = '';
	$param['param_TipoDoc'] = '';	

	$param['param_idDocumento'] = '';
	$param['param_idProducto'] = '';
    $param['param_cantidad'] = '';
	$param['param_precio']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idProducto'])){$param['param_idProducto'] = $_POST['param_idProducto'];}
    if(isset($_POST['param_fecha'])){$param['param_fecha'] = $_POST['param_fecha'];}
	if(isset($_POST['param_idCliente'])){$param['param_idCliente'] = $_POST['param_idCliente'];}
	if(isset($_POST['param_TipoDoc'])){$param['param_TipoDoc'] = $_POST['param_TipoDoc'];}
	if(isset($_POST['param_cantidad'])){$param['param_cantidad'] = $_POST['param_cantidad'];}
	if(isset($_POST['param_precio'])){$param['param_precio'] = $_POST['param_precio'];}
	if(isset($_POST['param_idDocumento'])){$param['param_idDocumento'] = $_POST['param_idDocumento'];}

	$ventaCliente = new VentaCliente_model();
	echo $ventaCliente->gestionar($param);


?>