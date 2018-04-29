<?php

	class Reservacion {

		private $idReservacion;
		private $fechaReservacion;
		private $fechaEntrada;
		private $fechaSalida;
		private $camaSupletoria;
		private $estado;
		private $observacion;
		private $idCliente;

		public function __construct($idReservacion,
					$fechaReservacion,
					$fechaEntrada,
					$fechaSalida,
					$camaSupletoria,
					$estado,
					$observacion,
					$idCliente){
			$this->idReservacion = $idReservacion;
			$this->fechaReservacion = $fechaReservacion;
			$this->fechaEntrada = $fechaEntrada;
			$this->fechaSalida = $fechaSalida;
			$this->camaSupletoria = $camaSupletoria;
			$this->estado = $estado;
			$this->observacion = $observacion;
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

		public function getIdCliente(){
			return $this->idCliente;
		}
		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}

		public function __toString(){
			return "IdReservacion: " . $this->idReservacion . 
				" FechaReservacion: " . $this->fechaReservacion . 
				" FechaEntrada: " . $this->fechaEntrada . 
				" FechaSalida: " . $this->fechaSalida . 
				" CamaSupletoria: " . $this->camaSupletoria . 
				" Estado: " . $this->estado . 
				" Observacion: " . $this->observacion . 
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

		// --- Función Futura ---
		public static function nombreFuncion1 ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion2 ($conexion){

		}
	}
?>