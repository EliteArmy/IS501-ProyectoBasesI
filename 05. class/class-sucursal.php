<?php

	class Sucursal {

		private $idSucursal;
		private $nombre;
		private $cantidadHabitaciones;
		private $telefono;
		private $email;
		private $direccion;
		private $descripcion;
		private $idRestaurante;
		private $idHotel;

		public function __construct($idSucursal,
					$nombre,
					$cantidadHabitaciones,
					$telefono,
					$email,
					$direccion,
					$descripcion,
					$idRestaurante,
					$idHotel){
			$this->idSucursal = $idSucursal;
			$this->nombre = $nombre;
			$this->cantidadHabitaciones = $cantidadHabitaciones;
			$this->telefono = $telefono;
			$this->email = $email;
			$this->direccion = $direccion;
			$this->descripcion = $descripcion;
			$this->idRestaurante = $idRestaurante;
			$this->idHotel = $idHotel;
		}

		public function getIdSucursal(){
			return $this->idSucursal;
		}
		public function setIdSucursal($idSucursal){
			$this->idSucursal = $idSucursal;
		}

		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getCantidadHabitaciones(){
			return $this->cantidadHabitaciones;
		}
		public function setCantidadHabitaciones($cantidadHabitaciones){
			$this->cantidadHabitaciones = $cantidadHabitaciones;
		}

		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}

		public function getDireccion(){
			return $this->direccion;
		}
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getIdRestaurante(){
			return $this->idRestaurante;
		}
		public function setIdRestaurante($idRestaurante){
			$this->idRestaurante = $idRestaurante;
		}

		public function getIdHotel(){
			return $this->idHotel;
		}
		public function setIdHotel($idHotel){
			$this->idHotel = $idHotel;
		}

		public function __toString(){
			return "IdSucursal: " . $this->idSucursal . 
				" Nombre: " . $this->nombre . 
				" CantidadHabitaciones: " . $this->cantidadHabitaciones . 
				" Telefono: " . $this->telefono . 
				" Email: " . $this->email . 
				" Direccion: " . $this->direccion . 
				" Descripcion: " . $this->descripcion . 
				" IdRestaurante: " . $this->idRestaurante . 
				" IdHotel: " . $this->idHotel;
		}

		// --- Función Futura ---
		public static function obtenerListaSucursales ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta(
				'SELECT suc.idSucursal, suc.nombre, suc.cantidadHabitaciones, suc.telefono,
				suc.direccion, suc.descripcion
				FROM Sucursal suc'
			);
			
			while($fila = $conexion->obtenerFila($resultado)){
				echo '<tr>';
				echo 		'<td>' . $fila["idSucursal"] . '</td>';
				echo 		'<td>' . $fila["nombre"] . '</td>';
				echo 		'<td>' . $fila["cantidadHabitaciones"] . '</td>';
				echo 		'<td>' . $fila["telefono"] . '</td>';
				echo 		'<td>' . $fila["direccion"] . '</td>';
				echo 		'<td>' . $fila["descripcion"] . '</td>';
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