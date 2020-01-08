<?php 
	include_once( "../../config/conexion.php");

	class Proveedor_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'listarProveedor':
					echo $this->listarProveedor();
					break;	
				case 'insert':
					echo $this->insert();
					break;	
				case 'editar':
					echo $this->editar();
					break;	
				case 'eliminar':
					echo $this->eliminar();
					break;
				
			}
	    }	

        private function listarProveedor(){
			global $database;
			$sql = "exec sp_mnt_Proveedor @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
		    foreach ($rows as $key => $v) {
		        $cont = $cont + 1;
            	$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'razonSocial' >".utf8_encode($v->RazonSocial)."</td>";
                    $tabla .= "<td id = 'ruc' >".utf8_encode($v->RUC)."</td>";
					   $tabla .= "<td> <button  id='btnShowEditar' style='margin-right:5px;' 
					   class='btn btn-xs btn-info' value='Desplazar' onclick='cargarDatosEditar(".$v->idProveedor.",".'"'.$v->RazonSocial.'"'.",".'"'.$v->RUC.'"'.")'>Editar</button>
					   <button id='btnEliminar' data-toggle='modal' class='btn btn-xs btn-danger' 
					   onclick='eliminar(".$v->idProveedor.")'>Eliminar</button></td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		private function insert(){	    	
	    	global $database;
			$sql = "exec sp_mnt_Proveedor @peticion=2,";
            $sql .= "@RazonSocial='".utf8_decode($this->param['param_razonSocial'])."',";	
            $sql .= "@RUC='".utf8_decode($this->param['param_ruc'])."'";
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); //
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}
		
		private function editar(){	    	
	    	global $database;
	    	$sql = "exec sp_mnt_Proveedor @peticion=3,";
			$sql .= "@idProveedor=".$this->param['param_idProveedor'].", ";
			$sql .= "@RazonSocial='".utf8_decode($this->param['param_razonSocial'])."',";	
            $sql .= "@RUC='".utf8_decode($this->param['param_ruc'])."'";		
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
		    return $respuesta;
	    }	 
	      
	    private function eliminar(){
	    	global $database;
	    	$sql = "exec sp_mnt_Proveedor @peticion=4,";
			$sql .= "@idProveedor=".$this->param['param_idProveedor'];
	    	$respuesta='';
	    	$database->setQuery($sql);
		    $rows = $database->loadObjectList();
	    	foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
	    	return $respuesta;
	    }

		
	}
?>