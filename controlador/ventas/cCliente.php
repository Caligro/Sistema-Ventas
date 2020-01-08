<?php 

	include_once '../../modelo/ventas/mCliente.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_idCliente'] = '';
    $param['param_nombre'] = '';	
	$param['param_direccion'] = '';
	$param['param_email'] = '';	
    $param['param_fono'] = '';
	$param['param_estado']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idCliente'])){$param['param_idCliente'] = $_POST['param_idCliente'];}
    if(isset($_POST['param_nombre'])){$param['param_nombre'] = $_POST['param_nombre'];}
	if(isset($_POST['param_direccion'])){$param['param_direccion'] = $_POST['param_direccion'];}
	if(isset($_POST['param_email'])){$param['param_email'] = $_POST['param_email'];}
	if(isset($_POST['param_fono'])){$param['param_fono'] = $_POST['param_fono'];}
	if(isset($_POST['param_estado'])){$param['param_estado'] = $_POST['param_estado'];}

	$Cliente = new Cliente_model();
	echo $Cliente->gestionar($param);


?>