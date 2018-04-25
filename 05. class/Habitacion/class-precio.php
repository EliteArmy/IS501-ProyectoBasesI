<?php

	class Precio {

		private $idPrecio;
		private $precio;
		private $fechaInicio;
		private $fechaFin;
		private $descripcion;
		private $idTipoHabitacion;
		private $idTipoCategoria;

		public function __construct(
					$idPrecio,
					$precio,
					$fechaInicio,
					$fechaFin,
					$descripcion,
					$idTipoHabitacion,
					$idTipoCategoria){
			$this->idPrecio = $idPrecio;
			$this->precio = $precio;
			$this->fechaInicio = $fechaInicio;
			$this->fechaFin = $fechaFin;
			$this->descripcion = $descripcion;
			$this->idTipoHabitacion = $idTipoHabitacion;
			$this->idTipoCategoria = $idTipoCategoria;
		}

		public function getIdPrecio(){
			return $this->idPrecio;
		}
		public function setIdPrecio($idPrecio){
			$this->idPrecio = $idPrecio;
		}

		public function getPrecio(){
			return $this->precio;
		}
		public function setPrecio($precio){
			$this->precio = $precio;
		}

		public function getFechaInicio(){
			return $this->fechaInicio;
		}
		public function setFechaInicio($fechaInicio){
			$this->fechaInicio = $fechaInicio;
		}

		public function getFechaFin(){
			return $this->fechaFin;
		}
		public function setFechaFin($fechaFin){
			$this->fechaFin = $fechaFin;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getIdTipoHabitacion(){
			return $this->idTipoHabitacion;
		}
		public function setIdTipoHabitacion($idTipoHabitacion){
			$this->idTipoHabitacion = $idTipoHabitacion;
		}

		public function getIdTipoCategoria(){
			return $this->idTipoCategoria;
		}
		public function setIdTipoCategoria($idTipoCategoria){
			$this->idTipoCategoria = $idTipoCategoria;
		}

		public function __toString(){
			return "IdPrecio: " . $this->idPrecio . 
				" Precio: " . $this->precio . 
				" FechaInicio: " . $this->fechaInicio . 
				" FechaFin: " . $this->fechaFin . 
				" Descripcion: " . $this->descripcion . 
				" IdTipoHabitacion: " . $this->idTipoHabitacion . 
				" IdTipoCategoria: " . $this->idTipoCategoria;
		}
	}
	
?>