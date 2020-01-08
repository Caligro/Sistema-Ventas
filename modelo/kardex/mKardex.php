<?php 
	include_once( "../../config/conexion.php");

	class Kardex_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'obtenerDatosxProducto':
					echo $this->obtenerDatosxProducto();
					break;	
				case 'imprimir':
					echo $this->imprimir();
					break;	
			}
	    }	

        private function obtenerDatosxProducto(){
			global $database;
			$sql = "exec sp_kardex @peticion=1,";
			$sql .= "@idProducto=".$this->param['param_idProducto'].", ";
            $sql .= "@fechaInicial='".$this->param['param_fechaInicial']."', ";
            $sql .= "@fechaFinal='".$this->param['param_fechaFinal']."'; ";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
		    foreach ($rows as $key => $v) {
		        $cont = $cont + 1;
            	$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'tipoMov' >".utf8_encode($v->TipoMov)."</td>";
					$tabla .= "<td id = 'fecha' >".$v->fecha."</td>";
					$tabla .= "<td id = 'cantidad' >".$v->Cantidad."</td>";
                    $tabla .= "<td id = 'stock' >".$v->stock."</td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		
        private function imprimir(){
			global $database;
			$sql = "exec sp_kardex @peticion=1,";
			$sql .= "@idProducto=".$this->param['param_idProducto'].", ";
            $sql .= "@fechaInicial='".$this->param['param_fechaInicial']."', ";
            $sql .= "@fechaFinal='".$this->param['param_fechaFinal']."'; ";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";$cont = 0;
			$array=[];
		    foreach ($rows as $key => $v) {
				$cont = $cont + 1;
				$array [$cont-1]= array(
					"cont" => strval($cont),
					"producto" =>utf8_encode($v->producto),
					"tipoMov" => utf8_encode($v->TipoMov),
					"fecha"=>$v->fecha,
					"cantidad"=>($v->Cantidad),
					"stock"=>($v->stock)
				);
            	
		    }
		    return json_encode($array);
		}
		

		
	}
	/*$tabla .= "<tr>";
                    $tabla .= "<td style=' width: 10%;'>".$cont."</td>";
                    $tabla .= "<td id = 'tipoMov' >".utf8_encode($v->TipoMov)."</td>";
					$tabla .= "<td id = 'fecha' >".$v->fecha."</td>";
					$tabla .= "<td id = 'cantidad' >".$v->Cantidad."</td>";
                    $tabla .= "<td id = 'stock' >".$v->stock."</td>";
                $tabla .= "</tr>";*/
?>

