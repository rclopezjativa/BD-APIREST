<?php
	require_once "modelos/conexion.php";
	require_once "controladores/post.controlador.php";
	if (isset($_POST)) {											// Si el requerieminto enviado es con el método POST
		$columnas = array();										// Se guardan los nombres de los campos enviados en el formulario del requerimiento.
		foreach(array_keys($_POST) as $k => $v){
			array_push($columnas, $v);
		}
		if (empty(Conexion::getColumnas(explode("?", $r_array[$i_EndPoint])[0], $columnas))) {
			$jfile = array (
				'status' => 400,
				'error' => $GLOBALS["err_code"],
				'result' => $GLOBALS["err_mensaje"], 				// 'Los campos del formulario no coinciden con los de la base de datos',
				'format' => 'MVC'
			);
			echo json_encode($jfile, http_response_code($jfile["status"]));
			return;
		}
		$resp = new postControlador(); 
		$resp->setDatos(explode("?", $r_array[$i_EndPoint])[0], $_POST, $verLog);
	}

?>