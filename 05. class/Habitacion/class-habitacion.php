<?php

	class Habitacion {

		private $idHabitacion;
		private $numeroHabitacion;
		private $numeroPiso;
		private $estado;
		private $descripcion;
		private $idTipoCategoria;
		private $idTipoHabitacion;
		private $idSucursal;

		public function __construct($idHabitacion,
					$numeroHabitacion,
					$numeroPiso,
					$estado,
					$descripcion,
					$idTipoCategoria,
					$idTipoHabitacion,
					$idSucursal){
			$this->idHabitacion = $idHabitacion;
			$this->numeroHabitacion = $numeroHabitacion;
			$this->numeroPiso = $numeroPiso;
			$this->estado = $estado;
			$this->descripcion = $descripcion;
			$this->idTipoCategoria = $idTipoCategoria;
			$this->idTipoHabitacion = $idTipoHabitacion;
			$this->idSucursal = $idSucursal;
		}

		public function getIdHabitacion(){
			return $this->idHabitacion;
		}
		public function setIdHabitacion($idHabitacion){
			$this->idHabitacion = $idHabitacion;
		}

		public function getNumeroHabitacion(){
			return $this->numeroHabitacion;
		}
		public function setNumeroHabitacion($numeroHabitacion){
			$this->numeroHabitacion = $numeroHabitacion;
		}

		public function getNumeroPiso(){
			return $this->numeroPiso;
		}
		public function setNumeroPiso($numeroPiso){
			$this->numeroPiso = $numeroPiso;
		}

		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getIdTipoCategoria(){
			return $this->idTipoCategoria;
		}
		public function setIdTipoCategoria($idTipoCategoria){
			$this->idTipoCategoria = $idTipoCategoria;
		}

		public function getIdTipoHabitacion(){
			return $this->idTipoHabitacion;
		}
		public function setIdTipoHabitacion($idTipoHabitacion){
			$this->idTipoHabitacion = $idTipoHabitacion;
		}

		public function getIdSucursal(){
			return $this->idSucursal;
		}
		public function setIdSucursal($idSucursal){
			$this->idSucursal = $idSucursal;
		}

		public function __toString(){
			return "IdHabitacion: " . $this->idHabitacion . 
				" NumeroHabitacion: " . $this->numeroHabitacion . 
				" NumeroPiso: " . $this->numeroPiso . 
				" Estado: " . $this->estado . 
				" Descripcion: " . $this->descripcion . 
				" IdTipoCategoria: " . $this->idTipoCategoria . 
				" IdTipoHabitacion: " . $this->idTipoHabitacion . 
				" IdSucursal: " . $this->idSucursal;
		}

		// --- Función Futura ---
		public static function obtenerListaHabitaciones ($conexion) {
						
			$resultado = $conexion->ejecutarConsulta(
				'SELECT hab.idHabitacion, hab.numeroHabitacion, hab.numeroPiso, hab.estado, hab.descripcion, 
					tcat.tipoCategoria, thab.tipoHabitacion 
				FROM Habitacion hab 
				INNER JOIN TipoCategoria tcat ON (hab.idTipoCategoria = tcat.idTipoCategoria)
				INNER JOIN TipoHabitacion thab ON (hab.idTipoHabitacion = thab.idTipoHabitacion)'
			);

			//echo $resultado;
			
			while($fila = $conexion->obtenerFila($resultado)){
				echo '<tr>';
				echo 		'<td>' . $fila["idHabitacion"] . '</td>';
				echo 		'<td>' . $fila["numeroHabitacion"] . '</td>';
				echo 		'<td>' . $fila["numeroPiso"] . '</td>';
				echo 		'<td>' . $fila["estado"] . '</td>';
				echo 		'<td>' . $fila["descripcion"] . '</td>';
				echo 		'<td>' . $fila["tipoCategoria"] . '</td>';
				echo 		'<td>' . $fila["tipoHabitacion"] . '</td>';
				echo '</tr>';
			}

		}

		// --- Función Futura  ---
		public static function nombreFuncion2 ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>