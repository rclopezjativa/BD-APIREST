<?php
	$r_method = ""; $verLog = false;					// Almacenar el método a procesar en la API y declarar la variable verLog para seguimiento
	if (isset($_GET["verLog"])) { $verLog = true; }				// Si no se envía como GET (verLog) no se muestra el seguimiento
	$i_EndPoint = 1;							// Configurar según el ambiente publicado
	$r_array = explode("/", $_SERVER['REQUEST_URI']);			// Capturo la dirección URL utilizada
	$r_array = array_filter($r_array);					// Cada elemento entre los caracteres "/" en un arreglo
	if (count($r_array) == 0) {						// Si no se envía EndPonit
		$jfile = array (
		'status' => 404,
		'result' => 'Not found',
		'format' => 'MVC'
		);
	} else {
		if(count($r_array) == $i_EndPoint) {				// Si se envía una petición URI con formato host/endpoint
			switch ($_SERVER["REQUEST_METHOD"]) {
				case "GET": 					// Detectar que es un método GET
					$r_method = "GET";
					include "servicios/get.php";		// Enrutar al archivo de procesamiento del método GET
					return;
				case "POST": 					// Detectar que es un método POST
					$r_method = "POST"; 
					include "servicios/post.php";		// Enrutar al archivo de procesamiento del método POST
					return;
				case "PUT": 	$r_method = "PUT"; break;	// Detectar que es un método PUT
				case "DELETE": 	$r_method = "DELETE"; break;	// Detectar que es un método DELETE
			}
		} else {
			$jfile = array (
				'status' => 200,
				'result' => 'Peticion general',
				'format' => 'MVC'
			);
		}
	}
	return;
?>
