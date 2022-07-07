<?php
	require_once "conexion.php";
	class GetModelo {		
		// Controlador para extraer datos de varios campos desde una tabla con where 
		// Para utilizar una o más expresiones de igualdad se envía en el parámetro $tipo en valor "w"
		// Para utilizar una expresión con operador LIKE y una o más expresiones de igualdad se env+ia en parámetro $tipo el valor "s"
		static public function getDatos_f($tabla, $campos, $c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $tipo = "w", $verLog = false) {
			$a_campos = explode(",", $campos);
			$cs_where = explode(",", $c_where);														// Los campos de filtro separados por ,
			$vs_where = explode("(,)", $v_where);													// Los valores de filtro separados por (,)
			$f_orden = "";
			$f_where = GetModelo::defineWhere($c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $tipo);	// Inicialmente el where se configura en espacio en blanco, sinó lo que se defina en los parametros
			foreach($cs_where as $k => $va) { array_push($a_campos, $va); }
			if (isset($ordenarPor))
			{  	$f_orden = GetModelo::addOrdenYLimites($ordenarPor, $orden, $desde, $hasta);			// llamar a la función para agregar orden y limites
				if(!in_array($ordenarPor, $a_campos)) { array_push($a_campos, $ordenarPor); }
			}
			if (isset($PerteneceA)) { if(!in_array($PerteneceA, $a_campos)) { array_push($a_campos, $PerteneceA); }}			
			if (isset($EntreCampo)) { if(!in_array($EntreCampo, $a_campos)) { array_push($a_campos, $EntreCampo); }}
			if(empty(Conexion::getColumnas($tabla, $a_campos))) { return null; }					// Verificar si la tabla existe en la base de datos
			$sql = "SELECT $campos from $tabla $f_where $f_orden"; 									// construye la sentencia SQL en base a los campos y tabla solicitados.
			$qry = Conexion::conecta()->prepare($sql);												// Conectar, contextualizar y preparar la sentencia.
			if($verLog) { echo $sql . "<br>"; }
			if ($f_where != "") {																	// Se realizará la asociación sólo si el where se define
				foreach($cs_where as $i_cmp => $v_cmp) {
					if(($tipo == "s" && $i_cmp > 0) || ($tipo == "w"))
					{ $qry->bindParam(":" . $v_cmp, $vs_where[$i_cmp], PDO::PARAM_STR);	}			// asociación del valor (enviado como parámetri) de cada campo compatado.
				}
			}
			try { 
				$qry->execute(); }																	// Ejecuta el query
			catch (PDOException $e) {
				$GLOBALS["err_mensaje"] = $e->getMessage(); $GLOBALS["err_code"] = $e->getCode();
				return null;
			}
			return $qry->fetchAll(PDO::FETCH_CLASS);												// Recupera respuesta : FETCH_CLASS -> traerá sólo los nombres de las columnas deseadas
		}
		// Controlador para extraer datos de varios campos desde un conjunto de tablas relacionadas (INNER JOIN), sin where
		// Para utilizar una o más expresiones de igualdad se envía en el parámetro $tipo en valor "w"
		// Para utilizar una expresión con operador LIKE y una o más expresiones de igualdad se env+ia en parámetro $tipo el valor "s"
		static public function getDatos_r($relaciones, $claves_relacionadas, $tabla, $campos, $c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $tipo = "w", $verLog = false) {
			$a_campos = explode(",", $campos);
			$cs_where = explode(",", $c_where);														// Los campos de filtro separados por ,
			$vs_where = explode("(,)", $v_where);													// Los valores de filtro separados por (,)
			$f_orden = "";
			$f_where = GetModelo::defineWhere($c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $tipo);	// Inicialmente el where se configura en espacio en blanco, sinó lo que se defina en los parametros
			foreach($cs_where as $k => $va) { array_push($a_campos, $va); }
			if (isset($ordenarPor))
			{  	$f_orden = GetModelo::addOrdenYLimites($ordenarPor, $orden, $desde, $hasta);		// llamar a la función para agregar orden y limites
				if(!in_array($ordenarPor, $a_campos)) { array_push($a_campos, $ordenarPor); }
			}
			$aRelaciones = explode(",", $relaciones);												// Las tablas que se van a relacionar con INNER JOIN separadas por ,
			$aParClavesRelaciones = explode(",", $claves_relacionadas);								// Los pares de campos utilizados para relaciones INNER separados con ,
			$f_inner = "";																			// Para armar el INNER JOIN
			if (count($aRelaciones)>1){
				if(empty(Conexion::getColumnas($aRelaciones[0], ["*"]))) { return null; }							// Verificar si la tabla existe en la base de datos
				foreach ($aRelaciones as $i_item => $d_item) {										// Por cada Item (tabla) se arma un INNER JOIN
					if($i_item > 0) {																// El Item [0] es la tabla principal del Select|
						if(empty(Conexion::getColumnas($d_item, ["*"]))) { return null; }							// Verificar si la tabla existe en la base de datos
						$aParClaves = explode(";", $aParClavesRelaciones[$i_item]);					// El par de claves a relacionar vienen separadas por ";"
						$f_inner .= "INNER JOIN " . $d_item  . " ON " . $aRelaciones[0] . "." . $aParClaves[0] . " = " . $d_item . "." . $aParClaves[1] . " ";
					}
				}
				$sql = "Select $campos from $aRelaciones[0] $f_inner $f_where $f_orden";			// Construye la sentencia SQL + inner + where
				$qry = Conexion::conecta()->prepare($sql);											// Conectar, contextualizar y preparar la sentencia.
				if($verLog) { echo $sql . "<br>"; }
				if ($f_where != "") {																// Se realizará la asociación sólo si el where se define
					foreach($cs_where as $i_cmp => $v_cmp) {
						if(($tipo == "s" && $i_cmp > 0) || ($tipo == "w"))
						{ $qry->bindParam(":" . $v_cmp, $vs_where[$i_cmp], PDO::PARAM_STR); }		// asociación del valor (enviado como parámetro) de cada campo compatado.
					}
				}
				try { 
					$qry->execute(); }																	// Ejecuta el query
				catch (PDOException $e) {
					$GLOBALS["err_mensaje"] = $e->getMessage(); $GLOBALS["err_code"] = $e->getCode();
					return null;
				}
				return $qry->fetchAll(PDO::FETCH_CLASS);											// Recupera respuesta : FETCH_CLASS -> traerá sólo los nombres de las columnas deseadas
			} else {
				return null;
			}
		}

		// Controlador para extraer datos de varios campos desde una tabla / se implementa un filtro específico.
		static public function getDatos($tabla, $campos, $filtro, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $ordenarPor, $orden, $desde, $hasta, $verLog = false){
			$a_campos = explode(",", $campos);
			$f_where = ""; $f_orden = ""; $f_clausula = "WHERE ";			
			if (isset($ordenarPor))
			{  	$f_orden = GetModelo::addOrdenYLimites($ordenarPor, $orden, $desde, $hasta);			// llamar a la función para agregar orden y limites
				if(!in_array($ordenarPor, $a_campos)) { array_push($a_campos, $ordenarPor); }
			}
			if (isset($PerteneceA)) 
			{ 	$f_conjunto = GetModelo::defineConjunto($PerteneceA, $Conjunto);
				$f_where .= "$f_clausula $f_conjunto"; $f_clausula = " AND "; 
				if(!in_array($PerteneceA, $a_campos)) { array_push($a_campos, $PerteneceA); }
			}			
			if (isset($EntreCampo)) 
			{ 	$f_between = GetModelo::defineBetween($EntreCampo, $valor1, $valor2);
				$f_where .= "$f_clausula $f_between"; 
				if(!in_array($EntreCampo, $a_campos)) { array_push($a_campos, $EntreCampo); }
			}
			if(empty(Conexion::getColumnas($tabla, $a_campos))) { return null; }					// Verificar si la tabla existe en la base de datos
			if ($filtro === "Si") { $f_where = " where estado_oferta_trabajo = 1"; } 				// Muestra sólo las ofertas de trabajo disponibles o habilitadas
			else { if ($filtro === "No") { $f_where = " where estado_oferta_trabajo = 0"; }}		// Muestra sólo las ofertas de trabajo no disponibles o no habilitadas
			if ($tabla == "UsuariosAsociadosOferta") 
			{ $sql = "SELECT ofertastrabajo.nombre_oferta_trabajo, usuarios.nombre_usuario, usuarios.correo_usuario FROM `usuariosoferta` INNER JOIN usuarios ON usuario_usuarios_oferta = usuarios.id_usuario INNER JOIN ofertastrabajo ON oferta_usuarios_oferta = ofertastrabajo.id_oferta_trabajo $f_orden"; } 
			else 
			{ $sql = "SELECT $campos from $tabla $f_where $f_orden"; }							// construye la sentencia SQL en base a los campos y tabla solicitados.
			if($verLog) { echo $sql . "\n"; }
			$qry = Conexion::conecta()->prepare($sql);												// Conectar, contextualizar y preparar la sentencia.
			try { 
				$qry->execute(); }																	// Ejecuta el query
			catch (PDOException $e) {
				$GLOBALS["err_mensaje"] = $e->getMessage(); $GLOBALS["err_code"] = $e->getCode();
				return null;
			}
			return $qry->fetchAll(PDO::FETCH_CLASS);												// Recupera respuesta : FETCH_CLASS -> traerá sólo los nombres de las columnas deseadas
		}

		// Función para agregar ordenamiento y limites
		static private function addOrdenYLimites($ordenarPor, $orden, $desde, $hasta) {
			$f_order = "";
			if(!is_null($ordenarPor)) {																// Se agrega la clausula para ordenar el resultado del query, si se envía
				$f_order .= " order by $ordenarPor ";
				if(!is_null($orden)) { $f_order .= " $orden"; }
			} 		
			if(!is_null($desde) && !is_null($hasta)) { $f_order .= " LIMIT $desde, $hasta"; }			// Se agrega la clausula para agregar Limites, si se envía			
			return $f_order;
		}
		
		// Función para agregar el filtro con where a la sentencia SQL
		// El tercer parámetro define el tipo de operación inicial (Like ('s') u otro operador ('w'))
		static private function defineWhere($c_where, $v_where, $PerteneceA, $Conjunto, $EntreCampo, $valor1, $valor2, $tipo = "w") {
			$cs_where = explode(",", $c_where);														// Los campos de filtro separados por ,
			$vs_where = explode("(,)", $v_where);													// Los valores de filtro separados por (,)
			$f_where = "";																			// Inicialmente el where se configura en espacio en blanco
			$clausula = "WHERE";
			if (isset($c_where)) {
				foreach($cs_where as $i_cmp => $v_cmp) {
					if ($i_cmp == 0 && $tipo == "s") 
					{ $f_where .= "$clausula $v_cmp LIKE '%" . $vs_where[0] . "%'"; }						// Si es el primer elemento del arreglo de where se escribe la expresión usando el operador "like".
					if ($i_cmp == 0 && $tipo == "w") 
					{ $f_where .= "$clausula " . $v_cmp . " = :" . $v_cmp . " "; }						// Si es el primer elemento del arreglo de where se escribe la expresión usando el operador "igual".
					if ($i_cmp > 0)  { $f_where .= "AND " . $v_cmp . " = :" . $v_cmp . " "; }		// Construcción de la cadena de filtro
				}
				$clausula = "AND";
			}
			$f_conjunto = GetModelo::defineConjunto($PerteneceA, $Conjunto);
			$f_between = GetModelo::defineBetween($EntreCampo, $valor1, $valor2);					// Llamar a la función para agregar la clausula BETWEEN
			if (isset($PerteneceA)) { $f_where .= " $clausula $f_conjunto "; $clausula = "AND"; }			
			if (isset($EntreCampo)) { $f_where .= " $clausula $f_between"; }
			return $f_where;
		}
		
		static private function defineBetween($EntreCampo, $valor1, $valor2) {
			$t_between = "";
			if(isset($EntreCampo)) { $t_between = "$EntreCampo BETWEEN $valor1 and $valor2"; }
			return $t_between;
		}
		
		static private function defineConjunto($PerteneceA, $Conjunto) {
			$t_conjunto = "";
			if(isset($PerteneceA)) { $t_conjunto = "$PerteneceA IN ($Conjunto)"; }
			return $t_conjunto;
		}
	}
?>