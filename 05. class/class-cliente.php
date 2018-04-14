<?php

	include_once("abstract-class-persona.php");

	class Cliente extends Persona {

		protected $idCliente;
		protected $fechaRegistro;
		protected $estado;
		protected $idPersona;

		public function __construct(
				$idPersona,
				$primerNombre,
				$segundoNombre,
				$primerApellido,
				$segundoApellido,
				$email,
				$password,
				$genero,
				$direccion,
				$fechaNacimiento,
				$imagenIdentificacion,

				$idCliente,
				$fechaRegistro,
				$estado,
				$idPersona) {
			parent::__construct(
					$idPersona,
					$primerNombre,
					$segundoNombre,
					$primerApellido,
					$segundoApellido,
					$email,
					$password,
					$genero,
					$direccion,
					$fechaNacimiento,
					$imagenIdentificacion);
			
			$this->idCliente = $idCliente;
			$this->fechaRegistro = $fechaRegistro;
			$this->estado = $estado;
			$this->idPersona = $idPersona;
		}


		public function getIdCliente(){
			return $this->idCliente;
		}
		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}

		public function getFechaRegistro(){
			return $this->fechaRegistro;
		}
		public function setFechaRegistro($fechaRegistro){
			$this->fechaRegistro = $fechaRegistro;
		}

		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getIdPersona(){
			return $this->idPersona;
		}
		public function setIdPersona($idPersona){
			$this->idPersona = $idPersona;
		}

		public function __toString(){
			return parent::__toString() . "IdCliente: " . $this->idCliente . 
				" FechaRegistro: " . $this->fechaRegistro . 
				" Estado: " . $this->estado . 
				" IdPersona: " . $this->idPersona;
		}

		// --- Función para obtener la Lista de Clientes ---
		public static function obternerListaClientes ($conexion) {

			$resultado = $conexion->ejecutarConsulta (
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)'
			);

			while ($fila = $conexion->obtenerFila($resultado)) {

				echo '<tr>';
				echo 		'<td>' . $fila["idPersona"] . '</td>';
				echo 		'<td>' . $fila["primerNombre"] . '</td>';
				echo 		'<td>' . $fila["primerApellido"] . '</td>';
				echo 		'<td>' . $fila["email"] . '</td>';
				echo 		'<td>' . $fila["fechaNacimiento"] . '</td>';
				echo 		'<td>' . $fila["fechaRegistro"] . '</td>';
				echo 		'<td>' . $fila["estado"] . '</td>';
				echo 		'<td>' . $fila["direccion"] . '</td>';
				echo '</tr>';

			}
		}

		// --- Función Futura ---
		public static function nombreFuncion ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion2 ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>