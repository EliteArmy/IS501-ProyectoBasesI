<?php

	include_once("abstract-class-persona.php");

	class Empleado extends Persona {

		protected $idEmpleado;
		protected $codigoEmpleado;
		protected $fechaIngreso;
		protected $fechaSalida;
		protected $estado;
		protected $idPersona;
		protected $idSucursal;
		protected $idEmpleadoSuperior;

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

				$idEmpleado,
				$codigoEmpleado,
				$fechaIngreso,
				$fechaSalida,
				$estado,
				$idSucursal,
				$idEmpleadoSuperior) {
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

			$this->idEmpleado = $idEmpleado;
			$this->codigoEmpleado = $codigoEmpleado;
			$this->fechaIngreso = $fechaIngreso;
			$this->fechaSalida = $fechaSalida;
			$this->estado = $estado;
			$this->idSucursal = $idSucursal;
			$this->idEmpleadoSuperior = $idEmpleadoSuperior;
		}


		public function getIdEmpleado(){
			return $this->idEmpleado;
		}
		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}

		public function getCodigoEmpleado(){
			return $this->codigoEmpleado;
		}
		public function setCodigoEmpleado($codigoEmpleado){
			$this->codigoEmpleado = $codigoEmpleado;
		}

		public function getFechaIngreso(){
			return $this->fechaIngreso;
		}
		public function setFechaIngreso($fechaIngreso){
			$this->fechaIngreso = $fechaIngreso;
		}

		public function getFechaSalida(){
			return $this->fechaSalida;
		}
		public function setFechaSalida($fechaSalida){
			$this->fechaSalida = $fechaSalida;
		}

		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getIdSucursal(){
			return $this->idSucursal;
		}
		public function setIdSucursal($idSucursal){
			$this->idSucursal = $idSucursal;
		}

		public function getIdEmpleadoSuperior(){
			return $this->idEmpleadoSuperior;
		}
		public function setIdEmpleadoSuperior($idEmpleadoSuperior){
			$this->idEmpleadoSuperior = $idEmpleadoSuperior;
		}

		public function __toString(){
			return parent::__toString() . "IdEmpleado: " . $this->idEmpleado . 
				" CodigoEmpleado: " . $this->codigoEmpleado . 
				" FechaIngreso: " . $this->fechaIngreso . 
				" FechaSalida: " . $this->fechaSalida . 
				" Estado: " . $this->estado . 
				" IdPersona: " . $this->idPersona . 
				" IdSucursal: " . $this->idSucursal . 
				" IdEmpleadoSuperior: " . $this->idEmpleadoSuperior;
		}

		// --- Función para obtener la Lista de Empleados ---
		public static function obtenerListaEmpleados ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta(
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento,
				emp.fechaIngreso, emp.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS edad
				FROM Persona per 
				INNER JOIN Empleado emp ON (per.idPersona = emp.idPersona)
				WHERE TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) >= "18"'
			);
			
			// Esto maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerEmpleados
			//$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerEmpleados");

			while($fila = $conexion->obtenerFila($resultado)){

				echo '<tr>';
				echo 		'<td id="">' . $fila["idEmpleado"] . '</td>';
				echo 		'<td id="">' . $fila["primerNombre"] . '</td>';
				echo 		'<td id="">' . $fila["primerApellido"] . '</td>';
				echo 		'<td id="">' . $fila["email"] . '</td>';
				echo 		'<td id="">' . $fila["fechaNacimiento"] . '</td>';
				echo 		'<td id="">' . $fila["fechaIngreso"] . '</td>';
				echo 		'<td id="">' . $fila["estado"] . '</td>';
				echo 		'<td id="">' . $fila["direccion"] . '</td>';
				echo '<td><button type="button" onclick="obtenerDetalleEmpleado('.$fila["idEmpleado"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button> 
						<button type="button" onclick="eliminarEmpleado('.$fila["idEmpleado"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
			}
		}

		// --- Función que Prepopula la informacion en el Modal ---
		public static function obtenerDetalleEmpleado ($conexion, $idEmpleado){
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"SELECT emp.idEmpleado, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, 
				per.email, tel.numeroTelefono, per.fechaNacimiento, emp.estado, per.direccion 
					FROM persona per
					INNER JOIN empleado emp ON (per.idPersona = emp.idPersona)
					INNER JOIN telefono tel ON (per.idPersona = tel.idPersona) 
					WHERE emp.idEmpleado = '$idEmpleado'
				");

			$fila = $conexion->obtenerFila($resultado);

			echo json_encode($fila);
		}


		// --- Función que Guardará la nueva información ---
		public function ActualizarEmpleado ($conexion, $idPersona){

		}

		// --- Función para Eliminar Empleados de la Base de Datos ---
		public static function eliminarEmpleado ($conexion, $idEmpleado) {
			
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per 
					FROM persona per
					INNER JOIN empleado emp ON (per.idPersona = emp.idPersona) 
					WHERE emp.idEmpleado = '$idEmpleado'
				");

			echo "<b>Registro Elimimnado con Exito</b>";

		}

		// --- Función Futura ---
		public static function nombreFuncion ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion2 ($conexion){

		}


	}
?>


