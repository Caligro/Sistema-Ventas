<?php 

	include_once '../../modelo/compras/mProveedor.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_idProveedor'] = '';
    $param['param_razonSocial'] = '';	
    $param['param_ruc'] = '';
	$param['param_estado']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idProveedor'])){$param['param_idProveedor'] = $_POST['param_idProveedor'];}
    if(isset($_POST['param_razonSocial'])){$param['param_razonSocial'] = $_POST['param_razonSocial'];}
    if(isset($_POST['param_ruc'])){$param['param_ruc'] = $_POST['param_ruc'];}
	if(isset($_POST['param_estado'])){$param['param_estado'] = $_POST['param_estado'];}

	$Proveedor = new Proveedor_model();
	echo $Proveedor->gestionar($param);


?>