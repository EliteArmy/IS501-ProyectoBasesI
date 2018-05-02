<?php

	class Reservacion {

		private $idReservacion;
		private $fechaReservacion;
		private $fechaEntrada;
		private $fechaSalida;
		private $camaSupletoria;
		private $estado;
		private $observacion;
		private $noAdultos;
		private $noNinos;
		private $idCliente;

		public function __construct(
					$idReservacion,
					$fechaReservacion,
					$fechaEntrada,
					$fechaSalida,
					$camaSupletoria,
					$estado,
					$observacion,
					$noAdultos,
					$noNinos,
					$idCliente){
			$this->idReservacion = $idReservacion;
			$this->fechaReservacion = $fechaReservacion;
			$this->fechaEntrada = $fechaEntrada;
			$this->fechaSalida = $fechaSalida;
			$this->camaSupletoria = $camaSupletoria;
			$this->estado = $estado;
			$this->observacion = $observacion;
			$this->noAdultos = $noAdultos;
			$this->noNinos = $noNinos;
			$this->idCliente = $idCliente;
		}

		public function getIdReservacion(){
			return $this->idReservacion;
		}
		public function setIdReservacion($idReservacion){
			$this->idReservacion = $idReservacion;
		}

		public function getFechaReservacion(){
			return $this->fechaReservacion;
		}
		public function setFechaReservacion($fechaReservacion){
			$this->fechaReservacion = $fechaReservacion;
		}

		public function getFechaEntrada(){
			return $this->fechaEntrada;
		}
		public function setFechaEntrada($fechaEntrada){
			$this->fechaEntrada = $fechaEntrada;
		}

		public function getFechaSalida(){
			return $this->fechaSalida;
		}
		public function setFechaSalida($fechaSalida){
			$this->fechaSalida = $fechaSalida;
		}

		public function getCamaSupletoria(){
			return $this->camaSupletoria;
		}
		public function setCamaSupletoria($camaSupletoria){
			$this->camaSupletoria = $camaSupletoria;
		}

		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getObservacion(){
			return $this->observacion;
		}
		public function setObservacion($observacion){
			$this->observacion = $observacion;
		}

		public function getNoAdultos(){
			return $this->noAdultos;
		}
		public function setNoAdultos($noAdultos){
			$this->noAdultos = $noAdultos;
		}

		public function getNoNinos(){
			return $this->noNinos;
		}
		public function setNoNinos($noNinos){
			$this->noNinos = $noNinos;
		}

		public function getIdCliente(){
			return $this->idCliente;
		}
		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}

		public function toString(){
			return "IdReservacion: " . $this->idReservacion . 
				" FechaReservacion: " . $this->fechaReservacion . 
				" FechaEntrada: " . $this->fechaEntrada . 
				" FechaSalida: " . $this->fechaSalida . 
				" CamaSupletoria: " . $this->camaSupletoria . 
				" Estado: " . $this->estado . 
				" Observacion: " . $this->observacion . 
				" NoAdultos: " . $this->noAdultos . 
				" NoNinos: " . $this->noNinos . 
				" IdCliente: " . $this->idCliente;
		}

		// --- Función que obtiene la Lista de Categorias ---
		public static function obtenerListaCategorias ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta (
				'SELECT idTipoCategoria, tipoCategoria, descripcion
				FROM TipoCategoria
			');

			while (($fila=$conexion->obtenerFila($resultado))){
				echo '<option value="'.$fila["idTipoCategoria"].'">'.$fila["tipoCategoria"].'</option>';
			}
		}

		// --- Función que Obtiene los Tipos de Habitacion  ---
		public static function obtenerListaTipos ($conexion){
			
			$resultado = $conexion->ejecutarConsulta (
				'SELECT idTipoHabitacion, tipoHabitacion, descripcion
				FROM TipoHabitacion
			');

			while (($fila=$conexion->obtenerFila($resultado))){
				echo '<option value="'.$fila["idTipoHabitacion"].'">'.$fila["tipoHabitacion"].'</option>';
			}

		}

		// --- Función Futura ---
		public static function obtenerListaSucursal ($conexion){
			$resultado = $conexion->ejecutarConsulta (
				"SELECT suc.idSucursal, suc.nombre, suc.cantidadHabitaciones, suc.telefono,
				suc.direccion, suc.descripcion
				FROM Sucursal suc
			");

			while (($fila = $conexion->obtenerFila($resultado))){
				echo '<option value="'.$fila["0"].'">'.$fila["1"].'</option>';
			}
		}

		// --- Función Futura ---
		public static function obtenerPrecio ($conexion, $categoria, $tipos){

			$resultado = $conexion->ejecutarConsulta (
				"SELECT pre.idPrecio, pre.precio, pre.descripcion
				FROM precio pre
				INNER JOIN tipocategoria cat ON (pre.idTipoHabitacion = cat.idTipoCategoria)
				INNER JOIN tipohabitacion hab ON (pre.idTipoHabitacion = hab.idTipoHabitacion)
				WHERE pre.idTipoHabitacion = '$tipos' AND pre.idtipoCategoria = '$categoria'
			");

			while (($fila = $conexion->obtenerFila($resultado))){
				echo '<option value="'.$fila["0"].'">'."Precio: ".$fila["1"]." ".$fila["2"].'</option>';
			}

			//echo "Finalizo en la funcion";
		}

		// --- Función Futura ---
		public static function obtenerHabitacion ($conexion, $sucursal){
			$resultado = $conexion->ejecutarConsulta (
				"SELECT hab.idHabitacion, hab.numeroHabitacion, hab.numeroPiso, hab.estado, hab.descripcion, suc.nombre
				FROM Habitacion hab 
				INNER JOIN sucursal suc ON (hab.idSucursal = suc.idSucursal)
				WHERE hab.idSucursal = '$sucursal' AND hab.estado = 'Disponible'
			");

			while (($fila = $conexion->obtenerFila($resultado))){
				echo '<option value="'.$fila["0"].'">'."Numero: ".$fila["1"].", Piso: ".$fila["2"].'</option>';
			}
		}

		// --- Función que obtiene el detalle del cliente que va a registrar una reservacion ---
		public static function obtenerDetalleCliente ($conexion, $correo){
			//echo "Entra en la funcion";

			// Consulta para verficar que existe el cliente
			$resultado = $conexion->ejecutarConsulta (
								
				"SELECT cli.idCliente, per.primerNombre, per.segundoNombre, per.primerApellido, 
						per.segundoApellido, per.email, tel.numeroTelefono, per.fechaNacimiento
				FROM Persona per
				INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
				INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
				WHERE per.email = '$correo'
			");
			
			// Indica la cantidad de registros encontrados
			$cantidadRegistros = $conexion->cantidadRegistros($resultado); 
			$respuesta = array();

			// $cantidadRegistros == 0, significa que No encontro un registro en la Base
			if ($cantidadRegistros == 0) {
				// Consulta para verificar si es un empleado
				$resultado = $conexion->ejecutarConsulta (
					"SELECT emp.idEmpleado, per.primerNombre, per.segundoNombre, per.primerApellido, 
						per.segundoApellido, per.email, tel.numeroTelefono, per.fechaNacimiento
					FROM Persona per
					INNER JOIN empleado emp ON (per.idPersona = emp.idPersona) 
					INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
					WHERE per.email = '$correo'
				");

				$cantidadRegistros = $conexion->cantidadRegistros($resultado); 
			} 

			// $cantidadRegistros == 1, significa que encontro un registro en la Base
			if ($cantidadRegistros == 1) {
				$fila = $conexion->obtenerFila($resultado);
				echo json_encode($fila);
			} else {
				$respuesta["mensaje"] = "No Existe Registro";
				echo json_encode($respuesta);
			}

		}

		// --- Función Futura ---
		public function registrarReservacion ($conexion){

			$accion = "Agregar";
			$null = "null";
			echo "Id: ". $this->idCliente;
			
			$sql_callSP = "CALL SP_RegistrarReservaciones("
						.$null. "," 
					  .$null. "," . 
					  "'".$this->fechaEntrada. "',".
					  "'".$this->fechaSalida. "',"
					  .$this->camaSupletoria. ",".
					  "'".$this->estado. "',".
					  "'".$this->observacion. "',"
					  .$this->idCliente. ","
					  .$this->noAdultos. ","
					  .$this->noNinos. ",".
					  "'".$accion."',". 
					  "@pcMensaje, 
					  @pbOcurrioError)";

			echo "<br>Lammado: " .$sql_callSP ."<br>"; 

			$resultado = $conexion->ejecutarConsulta($sql_callSP); // mysqli_query ($this->link, $sql);

			$return = $conexion->getParametroSP("@pcMensaje, @pbOcurrioError");

      if ($resultado != '1') { // 
        echo "Error: " . $resultado . " <br>";
      }

      $mensajeSP = $return['@pcMensaje'];
      $ocurreError = $return['@pbOcurrioError'];
      
      if ($ocurreError == "1"){
          echo '<b>'. $mensajeSP . '</b>'." !@!true" . " <br>";
      } else {
      	echo "<b>Registro Insertado con Exito</b><br>";
        //echo $mensajeSP . " !@!false" . " <br>";
      }
      //echo "Final Funcion";
		}

		// --- Función Futura ---
		public function registrarReservacionVieja ($conexion){

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO reservacion(idReservacion, fechaReservacion, fechaEntrada, fechaSalida,
				 camaSupletoria, estado, observacion, noAdultos, noNinos, idCliente) 
				
				VALUES (null, CURDATE(), '$this->fechaEntrada', '$this->fechaSalida', 
				'$this->camaSupletoria', '$this->estado', '$this->observacion', '$this->noAdultos', 
				'$this->noNinos', '$this->idCliente')
			");
		}

		// --- Función Futura ---
		public static function nombreFuncion2 ($conexion){
			// Cuerpo Funcion
		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){
			// Cuerpo Funcion
		}
	}
?>
