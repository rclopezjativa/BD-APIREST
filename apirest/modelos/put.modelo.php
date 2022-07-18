<?php
	require_once "conexion.php";
	class PutModelo {
		static public function updateDatos($tabla, $campos, $criterio, $verLog) {	// Función que permitirá actualizar datos en una tabla de la base de datos
			$campos_lista = ""; $union = ""; $inicio = 0;							// Variables de trabajo
			$clausula_w = ($criterio!=null)? "WHERE" : ""; 							// Si no se envía criterio no se aplicará la clausula WHERE
			foreach($campos as $k => $v)											// Se define la lista de campos y valores para almacenar 
			{	if($inicio > 0) { $union = ","; } else { $inicio += 1;}
				$campos_lista .= $union . $k . "=" . ":" . $k; 						// Enlistar pares campo/valor para la actualización.
			}
			$sql = "UPDATE $tabla SET $campos_lista $clausula_w $criterio";			// Senencia: Campos id y fecha_actualización no se consideran en el insert
			if($verLog) { echo $sql . "<br>"; }										// Si se pide ver el Query se configura parámerto verLog
			$conn = Conexion::conecta();											// Conexión a la base de datos
			$qry = $conn->prepare($sql);											// Se prepara la sentencia
			foreach($campos as $k => $v) 											// Se asocian los valores a los campos en la sentencia
			{ $qry->bindParam(":" . $k, $campos[$k], PDO::PARAM_STR); }
			if($qry->execute()) {													// Ejecución de query para la inserción
				$jfile = array (													// Resultado exitoso de la actualización.
					'status' => 200,	
					'resultado' => "Actualización exitosa a la tabla: $tabla",
					'formato' => 'MVC'
				);
			} else {
				$jfile = array (													// Resultado no exitoso de la actualización.
					'status' => 400,
					'resultado' => $qry->errorInfo(),
					'formato' => 'MVC'
				);
			}
			return $jfile;															// Retorno respuesta Array
		}
	}
?>