<?php

	class Conexion {
		
		private $host = "localhost";
		private $usuario = "root";
		private $password = "";
		private $baseDatos = "basedatoshotel";
		private $puerto = 3306;
		private $link;

		public function __construct(){
			$this->link = mysqli_connect(
				$this->host,
				$this->usuario,
				$this->password,
				$this->baseDatos,
				$this->puerto
			);
		}


		public function ejecutarConsulta($sql){
			return mysqli_query ($this->link, $sql);
		}

		public function ejecutarInstruccion($sql){
			return $this->enlace->query($sql);
		}
		
		public function obtenerFila($resultado){
			return mysqli_fetch_array ($resultado);
		}

		public function obtenerRegistro($resultado){
			return mysqli_fetch_assoc($resultado);
		}

		public function cerrarConexion(){
			mysqli_close ($this->link);
		}

		public function getLink(){
			return $this->link;
		}

		public function antiInyeccion($texto){
			return mysqli_real_escape_string ($this->link, $texto);
		}

		public function ultimoId(){
			return mysqli_insert_id ($this->link);
		}

		public function cantidadRegistros($resultado){
			return mysqli_num_rows($resultado);
		}

		public function getParametroSP ($parametros) {
      $res_sp = mysqli_query ($this->link, "SELECT " . $parametros . ";");
      $row = mysqli_fetch_assoc ($res_sp);
      return $row;
    }

	}

	/*$sql="SELECT Lastname,Age FROM Persons ORDER BY Lastname";
	$result=mysqli_query($con,$sql);

	// Associative array
	$row=mysqli_fetch_assoc($result);
	printf ("%s (%s)\n",$row["Lastname"],$row["Age"]);*/

?>

