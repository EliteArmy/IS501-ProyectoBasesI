<?php

	class Reservacio {

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

		// --- Función Futura ---
		public static function nombreFuncion ($conexion) {
			
		}

		// --- Función Futura  ---
		public static function nombreFuncion2 ($conexion){

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>