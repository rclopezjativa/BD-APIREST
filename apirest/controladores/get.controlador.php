<?php
	require_once "modelos/get.modelo.php";
	
	class GetControlador {
		// Controlador para extraer datos de varios campos desde una tabla con where utilizando el operador Like
		static public function getDatos_f($tabla, $campos, $c_where, $buscar, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $tipo, $verLog) {
			$resp = GetModelo::getDatos_f($tabla, $campos, $c_where, $buscar, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $tipo, $verLog);
			GetControlador::JSON_Respuesta($resp);
		}
		// Controlador para extraer datos de varios campos desde un conjunto de tablas relacionadas (INNER JOIN), sin where
		static public function getDatos_r($relaciones, $claves_relacionadas, $tabla, $campos, $c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $tipo, $verLog){
			$resp = GetModelo::getDatos_r($relaciones, $claves_relacionadas, $tabla, $campos, $c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $tipo, $verLog);
			GetControlador::JSON_Respuesta($resp);
		}
		// Controlador para extraer datos de varios campos desde una tabla / se implementa un filtro específico.
		static public function getDatos($tabla, $campos, $filtro, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $verLog) {
			$resp = GetModelo::getDatos($tabla, $campos, $filtro, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $verLog);
			GetControlador::JSON_Respuesta($resp);
		}
		// Retornar en formato JSON la información recuperada de la base de datos
		public function JSON_Respuesta($p_resp) {
			if (!empty($p_resp)) {
				$jfile = array ('status' => 200, 'registros' => count($p_resp), 'resultado' => 'OK', 'datos' => $p_resp);			
			} else {
				$jfile = array ('status' => 404, 'resultado' => 'No encontrado', 'mensaje' => $GLOBALS["err_mensaje"], 'error' => $GLOBALS["err_code"]);			
			}
			echo json_encode($jfile, http_response_code($jfile["status"]));		
		}
	}
?>