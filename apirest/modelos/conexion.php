<?php
	class Conexion {
		static public function infoDatabase(){						// Declarar datos de conexión a la base de datos
			$infoDB = array( 	"host" => "localhost",
								"dbname" => "bolsaempleo",
								"usuario" => "root",
								"clave" => ""
							);	
			return $infoDB;
		}
		static public function conecta() {							// Método de conexión a la base de datios
			try	{ $enlace = new PDO("mysql:host=".Conexion::infoDatabase()["host"].";dbname=".Conexion::infoDatabase()["dbname"],
								  Conexion::infoDatabase()["usuario"],
								  Conexion::infoDatabase()["clave"]
				);
				$enlace->exec("set name utf8");
			} catch (PDOException $e)								// Si se presenta error en la conexión 
			  { die("Error: " . $e->getMessage()); }
			return $enlace;
		}
		static public function getColumnas($tabla, $columnas){		// Función que verifica la existencia de la tabla y las columnas
			$db = Conexion::infoDatabase()["dbname"];
			$v = Conexion::conecta()								// Retornamos la conexión en el caso de ser válida
			->query("SELECT COLUMN_NAME as item FROM information_schema.columns WHERE table_schema = '$db' AND table_name = '$tabla'")
			->fetchAll(PDO::FETCH_OBJ);
			if(empty($v)){											// Si no retorna el esquema significa que no existe la tabla 
				$GLOBALS["err_mensaje"] = "No existe tabla: $tabla"; $GLOBALS["err_code"] = 100;
				return null;
			} else {
				if($columnas[0] == "*") { array_shift($columnas); }
				$s = 0;
				foreach($v as $h => $vi)							 
				{ $s += in_array($vi->item, $columnas); }			// Se verifican si existen las columnas 
				if($s == count($columnas)) { return $v; } 			// Si todas las columnas coinciden, no existe error
				else {												// Si no coinciden todos los campos consultados, existe error
					$GLOBALS["err_mensaje"] = "Los nombres de campo no coinciden en la tabla: $tabla"; 
					$GLOBALS["err_code"] = 101;
					return null;
				}
			}
		}
	}	
?>