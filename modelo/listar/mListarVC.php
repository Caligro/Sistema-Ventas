<?php 
	include_once( "../../config/conexion.php");

	class ListarVC_model{
		private $param = array();
	    private $con;

	    public function __construct(){

	    }	


	    public function gestionar($param){
	    	$this->param = $param;
	    	switch ($this->param['param_opcion'])
			{
				case 'listarVC':
					echo $this->listarVC();
                    break;	
                case 'mostrarDetalle':
                    echo $this->mostrarDetalle();
                    break;	
			}
        }	

        private function mostrarDetalle(){
			global $database;
			$sql = "exec sp_listarVC @peticion=2, ";
            $sql .= "@idDocumento=".$this->param['param_idDocumento'];
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";
		    foreach ($rows as $key => $v) {
		       
            	$tabla .= "<tr>";
                    $tabla .= "<td style='width:5%;'>".$v->idDocumento."</td>";
					$tabla .= "<td id='producto'>".utf8_encode($v->producto)."</td>";
					$tabla .= "<td id='cantidad'>".($v->Cantidad)."</td>";
                    $tabla .= "<td id='precio'>".($v->PrecUnt)."</td>";
                    
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}
        


        private function listarVC(){
			global $database;
			$sql = "exec sp_listarVC ";
			$sql .= "@peticion=".$this->param['param_Tipo'].", ";
            $sql .= "@fechaInicial='".$this->param['param_fechaInicial']."', ";
            $sql .= "@fechaFinal='".$this->param['param_fechaFinal']."'; ";
			$database->setQuery($sql);
			$rows=$database->loadObjectList();
			$tabla = "";
		    foreach ($rows as $key => $v) {
		       
            	$tabla .= "<tr>";
                    $tabla .= "<td style='width:5%;'>".$v->idDocumento."</td>";
                    $tabla .= "<td style='width:18%;' id ='fecha' >".$v->Fecha."</td>";
					$tabla .= "<td id = 'vendedor' >".utf8_encode($v->vendedor)."</td>";
					$tabla .= "<td  id = 'tipoDoc' >".utf8_encode($v->TipoDoc)."</td>";
                    $tabla .= "<td id = 'stock' >".utf8_encode($v->clienteProveedor)."</td>";
                    $tabla .= "<td style='width:5%;'><a class='btn btn-primary btn-xs' onclick='mostrarDetalle(".$v->idDocumento.")'  ><i class='fa fa-check'> </i> DETALLE </a></td>";
                $tabla .= "</tr>";
		    }
		    return $tabla;
		}

		

		
	}
?>