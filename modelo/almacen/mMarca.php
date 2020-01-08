<?php 
	include_once( "../../config/conexion.php");

	class Marca_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'listarMarca':
					echo $this->listarMarca();
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

        private function listarMarca(){
			global $database;
			$sql = "exec sp_read_Marca @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
		    foreach ($rows as $key => $v) {
				$descripcion=utf8_encode($v->Descripcion);
		        $cont = $cont + 1;
            	$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'descripcion' >".utf8_encode($v->Descripcion)."</td>";
					   $tabla .= "<td> <button  id='btnShowEditar' style='margin-right:5px;' 
					   class='btn btn-xs btn-info' value='Desplazar' onclick='cargarDatosEditar(".$v->idMarca.",".'"'.$descripcion.'"'.")'>Editar</button>
					   <button id='btnEliminar' data-toggle='modal' class='btn btn-xs btn-danger' 
					   onclick='eliminar(".$v->idMarca.")'>Eliminar</button></td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		private function insert(){	    	
	    	global $database;
			$sql = "exec sp_read_Marca @peticion=2,";
			$sql .= "@descripcion='".utf8_decode($this->param['param_descripcion'])."'";	
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); //
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}
		
		private function editar(){	    	
	    	global $database;
	    	$sql = "exec sp_read_Marca @peticion=3,";
			$sql .= "@idMarca=".$this->param['param_idMarca'].", ";
			$sql .= "@descripcion='".utf8_decode($this->param['param_descripcion'])."';";			
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
		    return $respuesta;
	    }	 
	      
	    private function eliminar(){
	    	global $database;
	    	$sql = "exec sp_read_Marca @peticion=4,";
			$sql .= "@idMarca=".$this->param['param_idMarca'];
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