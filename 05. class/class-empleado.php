<?php

	include_once("abstract-class-persona.php");

	class Empleado extends Persona {

		protected $idEmpleado;
		protected $codigoEmpleado;
		protected $fechaIngreso;
		protected $fechaSalida;
		protected $estado;
		protected $idSucursal;
		protected $idEmpleadoSuperior;

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

				$idEmpleado,
				$codigoEmpleado,
				$fechaIngreso,
				$fechaSalida,
				$estado,
				$idSucursal,
				$idEmpleadoSuperior,

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

			$this->idEmpleado = $idEmpleado;
			$this->codigoEmpleado = $codigoEmpleado;
			$this->fechaIngreso = $fechaIngreso;
			$this->fechaSalida = $fechaSalida;
			$this->estado = $estado;
			$this->idSucursal = $idSucursal;
			$this->idEmpleadoSuperior = $idEmpleadoSuperior;

			$this->telefono = $telefono;
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

		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function __toString(){
			return parent::__toString() . "IdEmpleado: " . $this->idEmpleado . 
				" CodigoEmpleado: " . $this->codigoEmpleado . 
				" FechaIngreso: " . $this->fechaIngreso . 
				" FechaSalida: " . $this->fechaSalida . 
				" Estado: " . $this->estado . 
				" IdPersona: " . $this->idPersona . 
				" IdSucursal: " . $this->idSucursal . 
				" IdEmpleadoSuperior: " . $this->idEmpleadoSuperior . 
				" Telefono: " . $this->telefono;
		}

		// --- Función para obtener la Lista de Empleados ---
		public static function obtenerListaEmpleados ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta(
				'SELECT emp.idEmpleado, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento,
				emp.fechaIngreso, emp.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS Edad
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


		// --- Función para obtener la Lista de Empleados ---
		public static function obtenerListaEmpleados2 ($conexion) {
			//echo "Entra en la funcion2";

			$resultado = $conexion->ejecutarConsulta(
				'SELECT emp.idEmpleado, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento,
				emp.fechaIngreso, emp.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS Edad
				FROM Persona per 
				INNER JOIN Empleado emp ON (per.idPersona = emp.idPersona)
				WHERE TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) >= "18"'
			);
			
			$data = array();

			while ($fila = $conexion->obtenerFila($resultado)){
				$data[] = $fila;
			}

			$i = 0;

			foreach ($data as $key) {
				$data[$i]['opciones'] = '<td><button type="button" onclick="obtenerDetalleEmpleado('.$data[$i]["idEmpleado"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button> 
						<button type="button" onclick="eliminarEmpleado('.$data[$i]["idEmpleado"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				$i++;
			}

			$datax = array('data' => $data);

			echo json_encode($datax);

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

		// --- Función que Guardara un nuevo Registro ---
		public function registrarEmpleado ($conexion){
			
			$passwordHash = md5($this->password);
			$telefono = $this->telefono->getNumeroTelefono();
			$accion = "Agregar";
			
			//echo "Entra en la Funcion";
			//$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerEmpleados");

			$sql_callSP = "CALL SP_RegistrarEmpleado(" .null. "," .$this->codigoEmpleado. "," . $this->primerNombre . ","
			 .$this->segundoNombre. ", " .$this->primerApellido. "," . $this->segundoApellido . ", " . $this->email . ","
			  .$passwordHash. "," .$this->genero. ", " .$this->direccion. "," .$this->fechaNacimiento. "," .null. "," 
			  .$telefono. "," .null. "," .null. "," .$this->estado. "," .null. "," .$this->idSucursal. "," .$this->idEmpleadoSuperior. ","
			   .$accion. ", @pcMensaje, @pbOcurrioError);";

			$resultado = $conexion->ejecutarConsulta($sql_callSP); // mysqli_query ($this->link, $sql);

			$return = $conexion->getParametroSP("@pcMensaje, @pbOcurrioError");

      if ($resultado != '1') {
        echo "Error: " . $resultado . " <br>";
      }

      $mensajeSP = $return['@pcMensaje'];
      $ocurreError = $return['@pbOcurrioError'];
      
      if ($ocurreError == "1"){
          echo $mensajeSP . " !@!true" . " <br>";
      } else {
      	echo "<b>Registro Insertado con Exito</b><br>";
        echo $mensajeSP . " !@!false" . " <br>";
      }

      //echo "Final Funcion";

		}

		// --- Función que Guardara un nuevo Registro ---
		public function registrarEmpleadoviejo ($conexion){
			
			$passwordHash = md5($this->password);

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO persona 
				(idPersona, primerNombre, segundoNombre, primerApellido, segundoApellido, 
				email, password, genero, direccion, fechaNacimiento, imagenIdentificacion) 
				VALUES (null, '$this->primerNombre', '$this->segundoNombre', '$this->primerApellido', 
				'$this->segundoApellido', '$this->email', '$passwordHash', '$this->genero', 
				'$this->direccion', '$this->fechaNacimiento', null)"
			);

			if(!($idTemporal = $conexion->ultimoId())){  // Obtener el ultimo Id de la persona que se inserto
				echo "<b>No se pudo Insertar el registro.</b>";
				return "";
			}

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO empleado 
				(idEmpleado, codigoEmpleado, fechaIngreso, fechaSalida, estado, idPersona, 
				idSucursal, idEmpleadoSuperior) 
				VALUES (null, '$this->codigoEmpleado', CURDATE(), null, '$this->estado', '$idTemporal', 
				'$this->idSucursal', '$this->idEmpleadoSuperior')
			");

			$telefono = $this->telefono->getNumeroTelefono();

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO telefono
				(idTelefono, numeroTelefono, idPersona) 
				VALUES (null, '$telefono', '$idTemporal')
			");

			echo "<b>Registro Insertado con Exito</b>";
		}

		// --- Función que Actualizara la información ---
		public function actualizarEmpleado ($conexion){

			$telefono = $this->telefono->getNumeroTelefono();
			//echo $telefono;

			$resultado = $conexion->ejecutarConsulta(
				"UPDATE persona per
				INNER JOIN empleado emp ON (per.idPersona = emp.idPersona)
				INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
				SET per.primerNombre = '$this->primerNombre',
					per.segundoNombre = '$this->segundoNombre',
					per.primerApellido = '$this->primerApellido',
					per.segundoApellido = '$this->segundoApellido',
					per.email = '$this->email',
					per.direccion = '$this->direccion',
					per.fechaNacimiento = '$this->fechaNacimiento',
					tel.numeroTelefono = '$telefono',
					emp.estado = '$this->estado'
				WHERE emp.idEmpleado = '$this->idEmpleado'
				");

			echo "<b>Registro actualizado con Exito</b>";

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

		// --- Función que obtiene la Lista de Sucursales ---
		public static function obtenerSucursalesEmpleado ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idSucursal, nombre 
				FROM sucursal'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idSucursal"].'">'.$fila["nombre"].'</option>';
			}
		}



	}
?>


