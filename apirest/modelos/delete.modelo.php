<?php
	require_once "conexion.php";
	class DeleteModelo {
		static public function deleteDatos($tabla, $criterio, $verLog) {			// Función que permitirá eliminar datos en una tabla de la base de datos
			$union = ""; $clausula_w = ($criterio!=null)? "WHERE" : "";				// Variables de trabajo, Si no se envía criterio no se aplicará la clausula WHERE
			$sql = "DELETE FROM $tabla $clausula_w $criterio";							// Senencia DELETE
			if($verLog) { echo $sql . "<br>"; }										// Si se pide ver el Query se configura parámerto verLog
			$conn = Conexion::conecta();											// Conexión a la base de datos
			$qry = $conn->prepare($sql);											// Se prepara la sentencia
			if($qry->execute()) {													// Ejecución de query para la eliminación
				$jfile = array (													// Resultado exitoso de la eliminación.
					'status' => 200,	
					'resultado' => "Eliminación exitosa a la tabla: $tabla",
					'formato' => 'MVC'
				);
			} else {
				$jfile = array (													// Resultado no exitoso de la eliminación.
					'status' => 404,
					'resultado' => $qry->errorInfo(),
					'formato' => 'MVC'
				);
			}
			return $jfile;															// Retorno respuesta Array
		}
	}
?>