<?php 
	include_once( "../../config/conexion.php");

	class Cliente_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'listarCliente':
					echo $this->listarCliente();
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

        private function listarCliente(){
			global $database;
			$sql = "exec sp_mnt_Cliente @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
			
		    foreach ($rows as $key => $v) {
			$nombre=utf8_encode($v->Nombre);
			$direccion=utf8_encode($v->Direccion);
			$email=utf8_encode($v->email);
			$fono=utf8_encode($v->Fono);
		        $cont = $cont + 1;
            	$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'nombre' >".$nombre."</td>";
					$tabla .= "<td id = 'direccion' >".$direccion."</td>";
					$tabla .= "<td id = 'email' >".$email."</td>";
                    $tabla .= "<td id = 'fono' >".$fono."</td>";
					   $tabla .= "<td> <button  id='btnShowEditar' style='margin-right:5px;' 
					   class='btn btn-xs btn-info' value='Desplazar' onclick='cargarDatosEditar(".$v->idCliente.",".'"'.$nombre.'"'.",".'"'.$direccion.'"'.",".'"'.$email.'"'.",".'"'.$fono.'"'.")'>Editar</button>
					   <button id='btnEliminar' data-toggle='modal' class='btn btn-xs btn-danger' 
					   onclick='eliminar(".$v->idCliente.")'>Eliminar</button></td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		private function insert(){	    	
	    	global $database;
			$sql = "exec sp_mnt_Cliente @peticion=2,";
			$sql .= "@nombre='".utf8_decode($this->param['param_nombre'])."',";
			$sql .= "@direccion='".utf8_decode($this->param['param_direccion'])."',";
			$sql .= "@email='".utf8_decode($this->param['param_email'])."',";	
            $sql .= "@Fono='".utf8_decode($this->param['param_fono'])."'";
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); //
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}
		
		private function editar(){	    	
	    	global $database;
	    	$sql = "exec sp_mnt_Cliente @peticion=3,";
			$sql .= "@idCliente=".$this->param['param_idCliente'].", ";
			$sql .= "@nombre='".utf8_decode($this->param['param_nombre'])."',";
			$sql .= "@direccion='".utf8_decode($this->param['param_direccion'])."',";
			$sql .= "@email='".utf8_decode($this->param['param_email'])."',";	
            $sql .= "@Fono='".utf8_decode($this->param['param_fono'])."'";		
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
		    return $respuesta;
	    }	 
	      
	    private function eliminar(){
	    	global $database;
	    	$sql = "exec sp_mnt_Cliente @peticion=4,";
			$sql .= "@idCliente=".$this->param['param_idCliente'];
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