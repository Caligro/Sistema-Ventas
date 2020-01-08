<?php 

	include_once '../../modelo/listar/mListarVC.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_Tipo'] = '';
	$param['param_fechaInicial'] = '';	
    $param['param_fechaFinal']='';
    $param['param_idDocumento']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_Tipo'])){$param['param_Tipo'] = $_POST['param_Tipo'];}
	if(isset($_POST['param_fechaInicial'])){$param['param_fechaInicial'] = $_POST['param_fechaInicial'];}
    if(isset($_POST['param_fechaFinal'])){$param['param_fechaFinal'] = $_POST['param_fechaFinal'];}
    if(isset($_POST['param_idDocumento'])){$param['param_idDocumento'] = $_POST['param_idDocumento'];}

	$ListarVC = new ListarVC_model();
	echo $ListarVC->gestionar($param);


?>