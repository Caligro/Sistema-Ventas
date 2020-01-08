<?php 
	include_once( "../../config/conexion.php");

	class Producto_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'listarProducto':
					echo $this->listarProducto();
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
                case 'llenarcboMarca':
                    echo $this->llenarcboMarca();
                    break;
				
			}
	    }	

        private function listarProducto(){
			global $database;
			$sql = "exec sp_mnt_Producto @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
		    foreach ($rows as $key => $v) {
		        $cont = $cont + 1;
            	$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'marca' >".utf8_encode($v->marca)."</td>";
                    $tabla .= "<td id = 'producto' >".utf8_encode($v->producto)."</td>";
					$tabla .= "<td id = 'stock' >".$v->stock."</td>";
					$tabla .= "<td id = 'precioVenta' >".$v->PrecioVenta."</td>";
					$tabla .= "<td id = 'precioCosto' >".$v->PrecioCosto."</td>";
                    $tabla .= "<td id = 'um' >".utf8_encode($v->um)."</td>";
					$tabla .= "<td> <button  id='btnShowEditar' style='margin-right:5px;' 
					   class='btn btn-xs btn-info' value='Desplazar' onclick='cargarDatosEditar(".$v->idProducto.",".$v->idMarca.",".'"'.utf8_encode($v->producto).'"'.",".$v->stock.",".'"'.utf8_encode($v->um).'"'.",".$v->PrecioVenta.",".$v->PrecioCosto.")'>Editar</button>
					   <button id='btnEliminar' data-toggle='modal' class='btn btn-xs btn-danger' 
					   onclick='eliminar(".$v->idProducto.")'>Eliminar</button></td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		private function insert(){	    	
	    	global $database;
            $sql = "exec sp_mnt_Producto @peticion=2,";
            $sql .= "@idMarca=".$this->param['param_idMarca'].", ";	
            $sql .= "@descripcion='".utf8_decode($this->param['param_descripcion'])."', ";
			$sql .= "@stock=".$this->param['param_stock'].", ";		
			$sql .= "@PrecioCosto='".($this->param['param_PrecioCosto'])."', ";
            $sql .= "@PrecioVenta=".($this->param['param_PrecioVenta']).", ";	
            $sql .= "@uniMedida='".utf8_decode($this->param['param_uniMedida'])."';";
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); //
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}
		
		private function editar(){	    	
	    	global $database;
	    	$sql = "exec sp_mnt_Producto @peticion=3,";
			$sql .= "@idProducto=".$this->param['param_idProducto'].", ";
            $sql .= "@idMarca=".$this->param['param_idMarca'].", ";	
            $sql .= "@descripcion='".utf8_decode($this->param['param_descripcion'])."', ";
            $sql .= "@stock=".$this->param['param_stock'].", ";		
            $sql .= "@uniMedida='".utf8_decode($this->param['param_uniMedida'])."';";		
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
		    return $respuesta;
	    }	 
	      
	    private function eliminar(){
	    	global $database;
	    	$sql = "exec sp_mnt_Producto @peticion=4,";
			$sql .= "@idProducto=".$this->param['param_idProducto'];
	    	$respuesta='';
	    	$database->setQuery($sql);
		    $rows = $database->loadObjectList();
	    	foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }
	    	return $respuesta;
        }
        
        private function llenarcboMarca(){
            global $database;
			$sql = "exec sp_read_Marca @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
            $combo = "<option value='0' disabled='disabled' selected='selected'>Seleccionar</option>";
		    foreach ($rows as $key => $v) {
                $descripcion=utf8_encode($v->Descripcion);
                $combo .= "<option value='".$v->idMarca."'>".$descripcion."</option>";
		    }
		    return $combo;
        }
        

		
	}
?>