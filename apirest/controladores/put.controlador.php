<?php
	require_once "modelos/put.modelo.php";
	Class PutControlador {															// Controlador para enviar datos a una tabla.
		static public function updateDatos($tabla, $campos, $criterio, $verLog) {	// Función que permitirá ingresar datos a una tabla 
			$resp = PutModelo::updateDatos($tabla, $campos, $criterio, $verLog);	// invocación al modelo
			PutControlador::JSON_Respuesta($resp);									// Mostrar respuesta en formato JSON
		}
		public function JSON_Respuesta($p_resp) {									// Retorna en formato JSON la respuesta de la base de datos
			if (!empty($p_resp)) { $jfile = $p_resp; } 								// Si se envía respuesta
			else 
			{ $jfile = array (	'status' => 404, 									// Si no se envía respuesta
								'metodo' => 'PUT',
								'resultado' => 'No encontrado', 
								'mensaje' => $GLOBALS["err_mensaje"], 
								'error' => $GLOBALS["err_code"]
							);			
			}
			echo json_encode($jfile, http_response_code($jfile["status"]));			// Mostrar JSON
		}
	}
?>