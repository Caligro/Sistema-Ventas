<?php 

	include_once '../../modelo/almacen/mMarca.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_idMarca'] = '';
	$param['param_descripcion'] = '';	
	$param['param_estado']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idMarca'])){$param['param_idMarca'] = $_POST['param_idMarca'];}
	if(isset($_POST['param_descripcion'])){$param['param_descripcion'] = $_POST['param_descripcion'];}
	if(isset($_POST['param_estado'])){$param['param_estado'] = $_POST['param_estado'];}

	$Marca = new Marca_model();
	echo $Marca->gestionar($param);


?>