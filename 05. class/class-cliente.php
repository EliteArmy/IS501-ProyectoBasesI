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
				$estado) {
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
<<<<<<< HEAD
		public static function obtenerListaClientes ($conexion) {

			/*$resultado = $conexion->ejecutarConsulta (
=======
		public static function obternerListaClientes ($conexion) {
			/*
			// Ahora se maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerClientes
			$resultado = $conexion->ejecutarConsulta (
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)'
<<<<<<< HEAD
			);*/

=======
			);
			*/
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
			$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerClientes");

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
				echo '<td><button type="button" onclick="editarCliente('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-edit"></span></button>  
<<<<<<< HEAD
											<button type="button" onclick="eliminarCliente('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
						echo '</tr>';
=======
									<button type="button" onclick="eliminarCliente('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7

			}
		}

<<<<<<< HEAD
		//Función que elimina los clientes
		public static function eliminarCliente ($conexion, $idCliente) {
			
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE cli.idCliente = '$idCliente'
				");

		}

		// --- Función Futura ---
		public static function nombreFuncion ($conexion){
=======
		// --- Función para Eliminar Clientes de la Base de Datos ---
		public static function eliminarCliente ($conexion, $idCliente){
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7

			//echo "Entra en la función";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE per.idPersona = '$idCliente'
				");
		}

		// --- Función Futura ---
		public static function nombreFuncion2 ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>