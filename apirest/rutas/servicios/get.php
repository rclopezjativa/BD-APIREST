<?php
	
	require_once "controladores/get.controlador.php";

	// --------------------------------------------------------------------------------------------------
	// getDatos        => Proceso que obtiene la lista de datos y registros 
	//					  Query fijo en el caso de enviar como tabla "UsuariosAsociadosOferta"
	//					  Un filtro fijo "estado_oferta_trabajo = 1" para odfertas de trabajo habilitadas
	// getDatos_f(w)   => Proceso que obtiene una lista de datos y registros aplicando la clausula where
	// getDatos_r      => Proceso que obtiene la lista de datos y registros de tablas relacionadas.
	// getDatos_f(s)   => Proceso que obtiene la lista de datos y registros de tablas utilizando en la 
	// 					  clausula where el operador like.
	// --------------------------------------------------------------------------------------------------
	// A todos se les puede aplicar ordenamiento y limite según clausulas de MySQL.
	// --------------------------------------------------------------------------------------------------
	// $_GET["campos"] => Por defecto mostrará todos los campos en la tabla o tablas relacionadas
	// --------------------------------------------------------------------------------------------------

	$resp = new GetControlador();
	$tipo = "w"; $verLog = false;
	if (isset($_GET["buscar"])) { $tipo = "s"; }
	if (isset($_GET["verLog"])) { $verLog = true; }
	
	if (isset($_GET["c_where"]) && isset($_GET["buscar"]) && !isset($_GET["relaciones"])) {
		$resp->getDatos_f(explode("?", $r_array[$i_EndPoint])[0], $_GET["campos"] ?? "*", $_GET["c_where"], $_GET["buscar"], $_GET["pertenece"] ?? null, $_GET["conjunto"] ?? null, $_GET["entre"] ?? null, $_GET["val1"] ?? null, $_GET["val2"] ?? null, $_GET["ordenarPor"] ?? null, $_GET["orden"] ?? null, $_GET["desde"] ?? null, $_GET["hasta"] ?? null, $tipo, $verLog);
	} else if (isset($_GET["c_where"]) && isset($_GET["v_where"]) && !isset($_GET["relaciones"])) {
		$resp->getDatos_f(explode("?", $r_array[$i_EndPoint])[0], $_GET["campos"] ?? "*", $_GET["c_where"], $_GET["v_where"], $_GET["pertenece"] ?? null, $_GET["conjunto"] ?? null, $_GET["entre"] ?? null, $_GET["val1"] ?? null, $_GET["val2"] ?? null, $_GET["ordenarPor"] ?? null, $_GET["orden"] ?? null, $_GET["desde"] ?? null, $_GET["hasta"] ?? null, $tipo, $verLog);
	} else if(isset($_GET["relaciones"]) && isset($_GET["claves_relaciones"]) && explode("?", $r_array[1])[0] == "ListaUsuariosXOferta") {
		$resp->getDatos_r($_GET["relaciones"] ?? null, $_GET["claves_relaciones"] ?? null, explode("?", $r_array[1])[0], $_GET["campos"] ?? "*", $_GET["c_where"] ?? null, $_GET["v_where"] ?? ($_GET["buscar"] ?? null), $_GET["pertenece"] ?? null, $_GET["conjunto"] ?? null, $_GET["entre"] ?? null, $_GET["val1"] ?? null, $_GET["val2"] ?? null, $_GET["ordenarPor"] ?? null, $_GET["orden"] ?? null, $_GET["desde"] ?? null, $_GET["hasta"] ?? null, $tipo, $verLog);
	} else {
		$resp->getDatos(explode("?", $r_array[$i_EndPoint])[0], $_GET["campos"] ?? "*", $_GET["disponibles"] ?? "", $_GET["pertenece"] ?? null, $_GET["conjunto"] ?? null, $_GET["entre"] ?? null, $_GET["val1"] ?? null, $_GET["val2"] ?? null, $_GET["ordenarPor"] ?? null, $_GET["orden"] ?? null, $_GET["desde"] ?? null, $_GET["hasta"] ?? null, $verLog);
	}
		
?>