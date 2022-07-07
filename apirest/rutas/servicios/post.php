<?php

	require_once "modelos/conexion.php";
	 
	if (isset($_POST)) {
		$columnas = array();
		foreach(array_keys($_POST) as $k => $v){
			array_push($columnas, $v);
		}
		if (empty(Conexion::getColumnas(explode("?", $r_array[1])[0], $columnas))) {
			$jfile = array (
				'status' => 400,
				'result' => 'Los campos del formulario no coinciden con los de la base de datos',
				'format' => 'MVC'
			);
			echo json_encode($jfile, http_response_code($jfile["status"]));
			return;
		}
		$resp = new postControlador();
	}

?>