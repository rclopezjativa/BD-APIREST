<?php
	class Conexion {
		static public function infoDatabase(){
			$infoDB = array(
				"host" => "localhost",
				"dbname" => "bolsaempleo",
				"usuario" => "root",
				"clave" => ""
			);	
			return $infoDB;
		}
		
		static public function conecta() {
			try{
				$enlace = new PDO("mysql:host=".Conexion::infoDatabase()["host"].";dbname=".Conexion::infoDatabase()["dbname"],
								  Conexion::infoDatabase()["usuario"],
								  Conexion::infoDatabase()["clave"]
								 );
				$enlace->exec("set name utf8");
			}catch(PDOException $e){ die("Error: " . $e->getMessage()); }
			return $enlace;
		}
		
		static public function getColumnas($tabla, $columnas){
			$db = Conexion::infoDatabase()["dbname"];
			$v = Conexion::conecta()											// Retornamos la conexión en el caso de ser válida
			->query("SELECT COLUMN_NAME as item FROM information_schema.columns WHERE table_schema = '$db' AND table_name = '$tabla'")
			->fetchAll(PDO::FETCH_OBJ);
			if(empty($v)){
				$GLOBALS["err_mensaje"] = "No existe tabla: $tabla"; $GLOBALS["err_code"] = 100;
				return null;
			} else {
				if($columnas[0] == "*") { array_shift($columnas); }
				$s = 0;
				foreach($v as $h => $vi) { $s += in_array($vi->item, $columnas); }
				if($s == count($columnas)) {
					return $v;
				} else {
					$GLOBALS["err_mensaje"] = "Los nombres de columna no coinciden"; $GLOBALS["err_code"] = 101;
					return null;
				}
			}
		}
	}	
?>