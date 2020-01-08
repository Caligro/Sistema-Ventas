<?php 

	include_once '../../modelo/kardex/mKardex.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_idProducto'] = '';
	$param['param_fechaInicial'] = '';	
	$param['param_fechaFinal']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idProducto'])){$param['param_idProducto'] = $_POST['param_idProducto'];}
	if(isset($_POST['param_fechaInicial'])){$param['param_fechaInicial'] = $_POST['param_fechaInicial'];}
	if(isset($_POST['param_fechaFinal'])){$param['param_fechaFinal'] = $_POST['param_fechaFinal'];}

	$Kardex = new Kardex_model();
	echo $Kardex->gestionar($param);


?>