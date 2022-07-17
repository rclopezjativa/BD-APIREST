<?php
	ini_set('display_errors', 1);							// Permite mostrar el error
	ini_set('log_errors', 1);							// Crea el archivo de error
	ini_set('error_log', 'C:/xampp2/htdocs/ROLOPFOLIO/apirest/errorlogs/errlog');	// Ruta del archivo de error
	$err_mensaje = "";
	$err_code = 0;
	require_once "controladores/rutas.controlador.php";				// Incluir código del controlador de rutas
	header('Access-Control-Allow-Origin: *');					// Incluida para que no muestre error al ser invocado desde un formulario REACT
	$inicio = new rutasControlador();						// Instanciar el objeto controlador de rutas
	$inicio -> index();								// Ejecutar el método index() - disparador.
?>
