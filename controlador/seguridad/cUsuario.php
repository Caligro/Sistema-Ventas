<?php 

	include_once '../../modelo/seguridad/mUsuario.php';

	$param = array();
    $param['param_opcion'] = '';
    $param['param_idUsuario'] = '';
	$param['param_idVendedor'] = '';
    $param['param_rol'] = '';
    $param['param_nombre'] = '';
	$param['param_genero'] = '';
	$param['param_usuario']='';
	$param['param_contra']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idUsuario'])){$param['param_idUsuario'] = $_POST['param_idUsuario'];}
	if(isset($_POST['param_idVendedor'])){$param['param_idVendedor'] = $_POST['param_idVendedor'];}
    if(isset($_POST['param_rol'])){$param['param_rol'] = $_POST['param_rol'];}
    if(isset($_POST['param_nombre'])){$param['param_nombre'] = $_POST['param_nombre'];}
	if(isset($_POST['param_genero'])){$param['param_genero'] = $_POST['param_genero'];}
	if(isset($_POST['param_usuario'])){$param['param_usuario'] = $_POST['param_usuario'];}
	if(isset($_POST['param_contra'])){$param['param_contra'] = $_POST['param_contra'];}

	$Usuario = new Usuario_model();
	echo $Usuario->gestionar($param);


?>