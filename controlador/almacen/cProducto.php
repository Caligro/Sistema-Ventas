<?php 

	include_once '../../modelo/almacen/mProducto.php';

	$param = array();
    $param['param_opcion'] = '';
    $param['param_idProducto'] = '';
	$param['param_idMarca'] = '';
    $param['param_descripcion'] = '';
    $param['param_stock'] = '';
	$param['param_uniMedida'] = '';
	$param['param_PrecioVenta']='';
	$param['param_PrecioCosto']='';
	$param['param_estado']='';
	
	

	if(isset($_POST['param_opcion'])){$param['param_opcion'] = $_POST['param_opcion'];}
	if(isset($_POST['param_idProducto'])){$param['param_idProducto'] = $_POST['param_idProducto'];}
	if(isset($_POST['param_idMarca'])){$param['param_idMarca'] = $_POST['param_idMarca'];}
    if(isset($_POST['param_descripcion'])){$param['param_descripcion'] = $_POST['param_descripcion'];}
    if(isset($_POST['param_stock'])){$param['param_stock'] = $_POST['param_stock'];}
	if(isset($_POST['param_uniMedida'])){$param['param_uniMedida'] = $_POST['param_uniMedida'];}
	if(isset($_POST['param_PrecioVenta'])){$param['param_PrecioVenta'] = $_POST['param_PrecioVenta'];}
	if(isset($_POST['param_PrecioCosto'])){$param['param_PrecioCosto'] = $_POST['param_PrecioCosto'];}
	if(isset($_POST['param_estado'])){$param['param_estado'] = $_POST['param_estado'];}

	$Producto = new Producto_model();
	echo $Producto->gestionar($param);


?>