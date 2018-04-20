<?php

	include_once("abstract-class-persona.php");

	class Cliente extends Persona {

		protected $idCliente;
		protected $fechaRegistro;
		protected $estado;

		protected $telefono;

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

				$telefono) {
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

			$this->telefono = $telefono;
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

		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function __toString(){
			return parent::__toString() . "IdCliente: " . $this->idCliente . 
				" FechaRegistro: " . $this->fechaRegistro . 
				" Estado: " . $this->estado . 
				" Telefono: " . $this->telefono;
		}

		// --- Función para obtener la Lista de Clientes ---
		public static function obtenerListaClientes ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta (
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)'
			);
			
			// Esto maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerClientes
			//$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerClientes");

			while ($fila = $conexion->obtenerFila($resultado)) {

				echo '<tr>';
				echo 		'<td id="">' . $fila["idPersona"] . '</td>';
				echo 		'<td id="">' . $fila["primerNombre"] . '</td>';
				echo 		'<td id="">' . $fila["primerApellido"] . '</td>';
				echo 		'<td id="">' . $fila["email"] . '</td>';
				echo 		'<td id="">' . $fila["fechaNacimiento"] . '</td>';
				echo 		'<td id="">' . $fila["fechaRegistro"] . '</td>';
				echo 		'<td id="">' . $fila["estado"] . '</td>';
				echo 		'<td id="">' . $fila["direccion"] . '</td>';
				echo '<td><button type="button" onclick="seleccionarCliente('.$fila["idPersona"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarCliente('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
			}
		} 

		// --- Función que Prepopula la informacion en el Modal ---
		public static function obtenerDetalleCliente ($conexion, $idPersona){
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"SELECT per.idPersona, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, 
				per.email, tel.numeroTelefono, per.fechaNacimiento, cli.estado, per.direccion 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
					WHERE per.idPersona = '$idPersona'
				");

			$fila = $conexion->obtenerFila($resultado);

			echo json_encode($fila);

		}

		// --- Función que Guardará la nueva información ---
		public function actualizarCliente($conexion){
			
			$resultado = $conexion->ejecutarConsulta(
				"UPDATE persona per
				INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
				SET per.primerNombre = '$this->primerNombre',
				per.segundoNombre = '$this->segundoNombre',
				per.primerApellido = '$this->primerApellido',
				per.segundoApellido = '$this->segundoApellido',
				per.email = '$this->email',
				per.direccion = '$this->direccion',
				per.fechaNacimiento = '$this->fechaNacimiento'
				WHERE per.idPersona = '$this->idCliente'
				");

			echo "<b>Registro actualizado con exito</b>";

			/*UPDATE persona per
				INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
				SET per.primerNombre = 'dfdfg',
				per.segundoNombre = 'dfgdfgd',
				per.primerApellido = 'dfgdfg',
				per.segundoApellido = 'dfgdf' ,
				per.email = 'asd65156@gmail.com',
				per.direccion = 'esta es una direccion',
				per.fechaNacimiento = '1995-12-12'
				WHERE per.idPersona = '100';*/

		}

		// --- Función para Eliminar Clientes de la Base de Datos ---
		public static function eliminarCliente ($conexion, $idCliente){

			//echo "Entra en la función";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE per.idPersona = '$idCliente'
				");
		}

		// --- Función Futura ---
		public static function insertarRegistro($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion2($conexion){

		}


	}
?>