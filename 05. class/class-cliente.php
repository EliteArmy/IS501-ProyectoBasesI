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
				'SELECT cli.idCliente, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion,  TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS edad
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)
				WHERE TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) >= "18"'
			);
			
			// Esto maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerClientes
			//$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerClientes");

			while ($fila = $conexion->obtenerFila($resultado)) {

				echo '<tr>';
				echo 		'<td id="">' . $fila["idCliente"] . '</td>';
				echo 		'<td id="">' . $fila["primerNombre"] . '</td>';
				echo 		'<td id="">' . $fila["primerApellido"] . '</td>';
				echo 		'<td id="">' . $fila["email"] . '</td>';
				echo 		'<td id="">' . $fila["fechaNacimiento"] . '</td>';
				echo 		'<td id="">' . $fila["fechaRegistro"] . '</td>';
				echo 		'<td id="">' . $fila["estado"] . '</td>';
				echo 		'<td id="">' . $fila["direccion"] . '</td>';
				echo '<td><button type="button" onclick="obtenerDetalleCliente('.$fila["idCliente"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarCliente('.$fila["idCliente"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
			}
		} 

		// --- Función que Prepopula la informacion en el Modal ---
		public static function obtenerDetalleCliente ($conexion, $idCliente){
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"SELECT cli.idCliente, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, 
				per.email, tel.numeroTelefono, per.fechaNacimiento, cli.estado, per.direccion 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
					WHERE cli.idCliente = '$idCliente'
				");

			$fila = $conexion->obtenerFila($resultado);

			echo json_encode($fila);

		}

		// --- Función que Guardará la nueva información ---
		public function actualizarCliente($conexion){
			
			$telefono = $this->telefono->getNumeroTelefono();
			//echo $telefono;
			//$telefono = '+' . $telefono;

			$resultado = $conexion->ejecutarConsulta(
				"UPDATE persona per
				INNER JOIN cliente cli ON (per.idPersona = cli.idPersona)
				INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
				SET per.primerNombre = '$this->primerNombre',
				per.segundoNombre = '$this->segundoNombre',
				per.primerApellido = '$this->primerApellido',
				per.segundoApellido = '$this->segundoApellido',
				per.email = '$this->email',
				per.direccion = '$this->direccion',
				per.fechaNacimiento = '$this->fechaNacimiento',
				tel.numeroTelefono = '$telefono',
				cli.estado = '$this->estado'
				WHERE cli.idCliente = '$this->idCliente'
				");
			/*
			echo $this->telefono->getNumeroTelefono();
			echo '<br>';
			echo $this->estado;
			echo '<br>';
			echo '<br>';
			*/
			echo "<b>Registro actualizado con Exito</b>";
			
			/*
			Actualizar Clientes en varias tablas:
			UPDATE persona per
				INNER JOIN cliente cli ON (per.idPersona = cli.idPersona)
			  INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
			SET per.primerNombre = 'prueba',
				per.segundoNombre = 'prueba2',
				per.primerApellido = 'Prueba3',
				per.segundoApellido = 'dfgdf' ,
				per.email = 'asdf156@gmail.com',
				per.direccion = 'esta es una direccion',
				per.fechaNacimiento = '1995-12-12',
			  tel.numeroTelefono = '+50822548698',
			  cli.estado = 'Inactivo'
			WHERE per.idPersona = '105';

			*/

		}

		// --- Función para Eliminar Clientes de la Base de Datos ---
		public static function eliminarCliente ($conexion, $idCliente){

			//echo "Entra en la función";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE cli.idCliente = '$idCliente'
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