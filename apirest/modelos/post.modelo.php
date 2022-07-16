<?php
	require_once "conexion.php";
	class PostModelo {
		static public function setDatos($tabla, $campos, $verLog) {					// Función que permitirá ingresar datos a una tabla 
			$campos_lista = ""; $campos_valores = ""; $union = ""; $inicio = 0;		// Variables de trabajo
			foreach($campos as $k => $v)											// Se define la lista de campos y valores para almacenar 
			{	if($inicio > 0) { $union = ","; } else { $inicio += 1;}
				$campos_lista .= $union . $k;
				$campos_valores .= $union . ":" . $k; 
			}
			$sql = "INSERT INTO $tabla ($campos_lista) VALUES ($campos_valores)";	// Senencia: Campos id y fecha_actualización no se consideran en el insert
			if($verLog) { echo $sql . "<br>"; }										// Si se pide ver el Query se configura parámerto verLog
			$conn = Conexion::conecta();											// Conexión a la base de datos
			$qry = $conn->prepare($sql);											// Se prepara la sentencia
			foreach($campos as $k => $v) 											// Se asocian los valores a los campos en la sentencia
			{ $qry->bindParam(":" . $k, $campos[$k], PDO::PARAM_STR); }
			if($qry->execute()) {													// Ejecución de query para la inserción
				$jfile = array (													// Resultado exitoso.
					'status' => 200,	
					'id insertado' => $conn->lastInsertId(),						// Retornar el último indice ingresado
					'resultado' => "Inserción exitosa a la tabla: $tabla",
					'formato' => 'MVC'
				);
			} else {
				$jfile = array (													// Resultado no exitoso
					'status' => 400,
					'resultado' => $qry->errorInfo(),
					'formato' => 'MVC'
				);
			}
			return $jfile;															// Retorno respuesta Array
		}
	}
?>