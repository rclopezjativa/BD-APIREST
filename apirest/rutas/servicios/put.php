<?php
	require_once "modelos/conexion.php";
	require_once "controladores/put.controlador.php";
	$datos = array();
	$where = null;
	if(isset($_GET["PUT"])) {														// Para que se procese el método debe enviarse un parámetro llamado "PUT"
		if($verLog) { echo "Se va a procesar el método PUT \n"; }					// Log
		if(isset($_GET["criterio"]) && $_GET["criterio"] != "") {					// Si NO se envía criterio de actualización (Where), por prudencia no se ejecuta UPDATE sin un criterio de actualización
			$where = $_GET["criterio"]; 											// Si el criterio enviado es diferente de (espacio en blanco) se procesa el PUT
			if($verLog) { echo "Se va a actualizar la información con el siguiente criterio " . $_GET["criterio"] . "\n"; }		// Log
			parse_str(file_get_contents("php://input"), $datos);					// Se guarda en un arreglo los datos de formulario enviados para la actualización
			if($verLog) { print_r($datos); }										// Log
			$columnas = array();													// Se guardan los nombres de los campos enviados en el formulario del requerimiento.
			foreach(array_keys($datos) as $k => $v)									// Tomar los nombres de las columnas o campos a modificar o actualizar
			{ array_push($columnas, $v); }
			if (empty(Conexion::getColumnas(explode("?", $r_array[$i_EndPoint])[0], $columnas))) {	// Si los campos que se solicita actualizar cooinciden y existen en la tabla de la base de datos
				$jfile = array (
					'status' => 400,
					'error' => $GLOBALS["err_code"],
					'result' => $GLOBALS["err_mensaje"], 							// Los campos del formulario no coinciden con los de la base de datos,
					'format' => 'MVC'
				);
				echo json_encode($jfile, http_response_code($jfile["status"]));		// Mostrar el resultado JSON en caso de error
				return;
			}
			if($verLog) { echo "Los campos coinciden\n"; }							// Log
			$resp = new PutControlador(); 											// Se crea la instancia el objeto que controle el método PUT
			$resp->updateDatos(explode("?", $r_array[$i_EndPoint])[0], $datos, $where ?? null, $verLog);	// Invocar el método de actualización, enviando tabla, campos y criterio del proceso			
		} else {
			$GLOBALS["err_mensaje"]="Criterio para la actualización no especificado\n";
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