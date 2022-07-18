<?php
	require_once "modelos/conexion.php";
	require_once "controladores/delete.controlador.php";
	$datos = array();
	$where = null;
	if(isset($_GET["DELETE"])) {
		if($verLog) { echo "Se va a procesar el método DELETE \n"; }				// Log
		if(isset($_GET["criterio"]) && $_GET["criterio"] != "") {					// Si NO se envía criterio de eliminación (Where), por prudencia no se ejecuta DELETE sin un criterio de eliminación
			$where = $_GET["criterio"]; 											// Si el criterio enviado es diferente de (espacio en blanco) se procesa el DELETE
			if($verLog) { echo "Se va a eliminar la información con el siguiente criterio " . $_GET["criterio"] . "\n"; }		// Log
			$resp = new DeleteControlador(); 										// Se crea la instancia el objeto que controle el método DELETE
			$resp->deleteDatos(explode("?", $r_array[$i_EndPoint])[0], $where ?? null, $verLog);	// Invocar el método de eliminación, enviando tabla y criterio del proceso DELETE
		} else {
			$GLOBALS["err_mensaje"]="Criterio para la eliminación no especificado\n";
			if($verLog) { echo $GLOBALS["err_mensaje"]; }							// Log
			$jfile = array (
				'status' => 400,
				'error' => 102,
				'result' => $GLOBALS["err_mensaje"], 								// Los campos del formulario no coinciden con los de la base de datos,
				'format' => 'MVC'
			);
			echo json_encode($jfile, http_response_code($jfile["status"]));			// Mostrar el resultado JSON en caso de error
			return;
		}
	}
?>