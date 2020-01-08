<?php 
session_start();
	include_once( "../../config/conexion.php");

	class VentaCliente_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'insertarVenta':
					echo $this->insertarVenta();
					break;	
				case 'insertarDetalleVenta':
					echo $this->insertarDetalleVenta();
					break;	
                case 'llenarcboCliente':
                    echo $this->llenarcboCliente();
                    break;
                case 'llenarcboProducto':
                    echo $this->llenarcboProducto();
					break;
				case 'cargarDatosProd':
					echo $this->cargarDatosProd();
					break;
				case 'llenarcboProveedor':
					echo $this->llenarcboProveedor();
					break;
				case 'insertarCompra':
					echo $this->insertarCompra();
					break;
				case'insertarDetalleCompra':
					echo $this->insertarDetalleCompra();
					break;
			}
	    }	


		private function insertarVenta(){	    	
	    	global $database;
			$sql = "exec sp_venta_Cliente @peticion=4,";
			$sql .= "@fecha='".($this->param['param_fecha'])."',";
			$sql .= "@idCliente=".$this->param['param_idCliente'].",";
			$sql .= "@idVendedor=".$_SESSION['U_idVendedor'].",";
			$sql .= "@tipoDoc=".$this->param['param_TipoDoc'];
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}

		private function insertarCompra(){	    	
	    	global $database;
			$sql = "exec sp_venta_Cliente @peticion=7,";
			$sql .= "@fecha='".($this->param['param_fecha'])."',";
			$sql .= "@idProveedor=".$this->param['param_idCliente'].",";
			$sql .= "@idVendedor=".$_SESSION['U_idVendedor'].",";
			$sql .= "@tipoDoc=".$this->param['param_TipoDoc'];
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}

		private function insertarDetalleVenta(){	    	
	    	global $database;
			$sql = "exec sp_venta_Cliente @peticion=5,";
			$sql .= "@idDocumento='".($this->param['param_idDocumento'])."',";
			$sql .= "@idProducto=".$this->param['param_idProducto'].",";
			$sql .= "@cantidad=".$this->param['param_cantidad'].",";
			$sql .= "@precioUnt=".$this->param['param_precio'].",";
			$sql .= "@tipoDoc=".$this->param['param_TipoDoc'];
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}

		private function insertarDetalleCompra(){	    	
	    	global $database;
			$sql = "exec sp_venta_Cliente @peticion=8,";
			$sql .= "@idDocumento='".($this->param['param_idDocumento'])."',";
			$sql .= "@idProducto=".$this->param['param_idProducto'].",";
			$sql .= "@cantidad=".$this->param['param_cantidad'].",";
			$sql .= "@precioUnt=".$this->param['param_precio'].",";
			$sql .= "@tipoDoc=".$this->param['param_TipoDoc'];
			$database->setQuery($sql);
		    $rows = $database->loadObjectList(); 
		    foreach ($rows as $key => $v) {
		    	$respuesta=$v->respuesta;
		    }

        	return $respuesta;
		}
		
        
        private function llenarcboCliente(){
            global $database;
			$sql = "exec sp_venta_Cliente @peticion=1";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
            $combo = "<option value='0' disabled='disabled' selected='selected'>Seleccionar</option>";
		    foreach ($rows as $key => $v) {
                $nombre=utf8_encode($v->Nombre);
                $combo .= "<option value='".$v->idCliente."'>".$nombre."</option>";
		    }
		    return $combo;
		}
		
		private function llenarcboProveedor(){
            global $database;
			$sql = "exec sp_venta_Cliente @peticion=6";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
            $combo = "<option value='0' disabled='disabled' selected='selected'>Seleccionar</option>";
		    foreach ($rows as $key => $v) {
                $RazonSocial=utf8_encode($v->RazonSocial);
                $combo .= "<option value='".$v->idProveedor."'>".$RazonSocial."</option>";
		    }
		    return $combo;
        }
          
        private function llenarcboProducto(){
            global $database;
			$sql = "exec sp_venta_Cliente @peticion=2";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
            $combo = "<option value='0' disabled='disabled' selected='selected'>Seleccionar ...</option>";
		    foreach ($rows as $key => $v) {
                $Descripcion=utf8_encode($v->Descripcion);
                $combo .= "<option value='".$v->idProducto."'>".$Descripcion."</option>";
		    }
		    return $combo;
		}
		
		private function cargarDatosProd(){
			global $database;
			$sql = "exec sp_venta_Cliente @peticion=3, ";
			
			$sql .= "@idProducto=".$this->param['param_idProducto'];
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			
			foreach ($rows as $key => $v) {
				$array = array(
					"marca" => utf8_encode($v->marca),
					"idProducto" => ($v->idProducto),
					"producto"=>utf8_encode($v->producto),
					"precio"=>($v->precio),
					"stock"=>($v->stock)
				);
		    }          
		    return json_encode($array);
		}

		
	}
?>