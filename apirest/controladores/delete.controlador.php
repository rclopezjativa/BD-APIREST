<?php
	require_once "modelos/delete.modelo.php";
	Class DeleteControlador {														// Controlador para eliminar datos en una tabla.
		static public function deleteDatos($tabla, $criterio, $verLog) {			// Función que permitirá ingresar datos a una tabla 
			$resp = DeleteModelo::deleteDatos($tabla, $criterio, $verLog);			// invocación al modelo
			DeleteControlador::JSON_Respuesta($resp);								// Mostrar respuesta en formato JSON
		}
		public function JSON_Respuesta($p_resp) {									// Retorna en formato JSON la respuesta de la base de datos
			if (!empty($p_resp)) { $jfile = $p_resp; } 								// Si se envía respuesta
			else 
			{ $jfile = array (	'status' => 404, 									// Si no se envía respuesta
								'metodo' => 'DELETE',
								'resultado' => 'No encontrado', 
								'mensaje' => $GLOBALS["err_mensaje"], 
								'error' => $GLOBALS["err_code"]
							);			
			}
			echo json_encode($jfile, http_response_code($jfile["status"]));			// Mostrar JSON
		}
	}
?>