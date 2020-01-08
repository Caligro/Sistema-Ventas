<?php 
    session_start();  
	include_once( "../../config/conexion.php");

	class Usuario_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'listarUsuario':
					echo $this->listarUsuario();
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
                case 'llenarcboRol':
                    echo $this->llenarcboRol();
                    break;
                case 'login':
                    echo $this->login();
                    break;
				
			}
	    }	

        private function listarUsuario(){
			global $database;
			$sql = "exec sp_mnt_Usuario @peticion=2";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
		    foreach ($rows as $key => $v) {
		        $cont = $cont + 1;
            	$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'rol' >".utf8_encode($v->rol)."</td>";
                    $tabla .= "<td id = 'usuario' >".utf8_encode($v->usuario)."</td>";
					$tabla .= "<td id = 'nombre' >".utf8_encode($v->Nombre)."</td>";
					$tabla .= "<td> <button  id='btnShowEditar' style='margin-right:5px;' 
					   class='btn btn-xs btn-info' value='Desplazar' onclick='cargarDatosEditar(".$v->idRol.",".$v->idUsuario.",".$v->idVendedor.",".'"'.utf8_encode($v->Nombre).'"'.",".'"'.utf8_encode($v->usuario).'"'.",".'"'.utf8_encode($v->Genero).'"'.")'>Editar</button>
					   <button id='btnEliminar' data-toggle='modal' class='btn btn-xs btn-danger' 
					   onclick='eliminar(".$v->idUsuario.",".$v->idVendedor.")'>Eliminar</button></td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		private function insert(){	    	
	    	global $database;
            $sql = "exec sp_mnt_Usuario @peticion=3,";
            $sql .= "@nombreVendedor='".utf8_decode($this->param['param_nombre'])."', ";	
            $sql .= "@usuario='".utf8_decode($this->param['param_usuario'])."', ";
			$sql .= "@genero='".$this->param['param_genero']."', ";		
			$sql .= "@contra='".md5($this->param['param_contra'])."', ";
            $sql .= "@idRol=".($this->param['param_rol'])."; ";	
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}
		
		private function editar(){	    	
	    	global $database;
	    	$sql = "exec sp_mnt_Usuario @peticion=4,";
            $sql .= "@idUsuario=".$this->param['param_idUsuario'].", ";
            $sql .= "@idVendedor=".$this->param['param_idVendedor'].", ";
            $sql .= "@nombreVendedor='".utf8_decode($this->param['param_nombre'])."', ";	
            $sql .= "@usuario='".utf8_decode($this->param['param_usuario'])."', ";
			$sql .= "@genero='".$this->param['param_genero']."', ";
            $sql .= "@idRol=".($this->param['param_rol'])."; ";		
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
		    return $respuesta;
	    }	 
	      
	    private function eliminar(){
	    	global $database;
            $sql = "exec sp_mnt_Usuario @peticion=5,";
            $sql .= "@idUsuario=".$this->param['param_idUsuario'].", ";	
            $sql .= "@idVendedor=".$this->param['param_idVendedor'];
	    	$respuesta='';
	    	$database->setQuery($sql);
		    $rows = $database->loadObjectList();
	    	foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
	    	return $respuesta;
        }
        
        private function llenarcboRol(){
            global $database;
			$sql = "exec sp_mnt_Usuario @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
            $combo = "<option value='0' disabled='disabled' selected='selected'>Seleccionar</option>";
		    foreach ($rows as $key => $v) {
                $rol=utf8_encode($v->rol);
                $combo .= "<option value='".$v->idRol."'>".$rol."</option>";
		    }
		    return $combo;
        }
        
        private function login(){
            global $database;
		    $sql = "EXEC sp_login @peticion=1,
		    					@usuario='".$this->param['param_usuario']."',
		    					@contra='".md5($this->param['param_contra'])."'";
		    $database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		            $_SESSION['U_Nombre'] = $v->Nombre;		
					$_SESSION['U_idRol'] = $v->idRol;
                    $_SESSION['U_idVendedor'] = ($v->idVendedor);
                    $respuesta=$v->Nombre;
		    }
            return $respuesta;
        }

		
	}
?>