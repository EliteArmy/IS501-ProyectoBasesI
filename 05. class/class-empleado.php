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
				$idPersona,
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
			$this->idPersona = $idPersona;
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

		public function getIdPersona(){
			return $this->idPersona;
		}
		public function setIdPersona($idPersona){
			$this->idPersona = $idPersona;
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
			/*
			// Ahora se maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerEmpleados
			$resultado = $conexion->ejecutarConsulta(
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento,
				emp.fechaIngreso, emp.estado, per.direccion
				FROM Persona per 
				INNER JOIN Empleado emp ON (per.idPersona = emp.idPersona)'
			);
			*/

			$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerEmpleados");

			while($fila = $conexion->obtenerFila($resultado)){

						echo '<tr>';
						echo 		'<td>' . $fila["idPersona"] . '</td>';
						echo 		'<td>' . $fila["primerNombre"] . '</td>';
						echo 		'<td>' . $fila["primerApellido"] . '</td>';
						echo 		'<td>' . $fila["email"] . '</td>';
						echo 		'<td>' . $fila["fechaNacimiento"] . '</td>';
						echo 		'<td>' . $fila["fechaIngreso"] . '</td>';
						echo 		'<td>' . $fila["estado"] . '</td>';
						echo 		'<td>' . $fila["direccion"] . '</td>';
						echo '<td><button type="button" onclick="editarEmpleado('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-edit"></span></button>  
											<button type="button" onclick="eliminarEmpleado('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
						echo '</tr>';
			}
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
		}

		// --- Función Futura ---
		public static function nombreFuncion2 ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>


