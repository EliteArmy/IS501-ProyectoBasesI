<?php

	class Descuento {

		private $idDescuento;
		private $porcentaje;
		private $estado;
		private $fechaInicio;
		private $fechaFin;
		private $descripcion;

		public function __construct($idDescuento,
					$porcentaje,
					$estado,
					$fechaInicio,
					$fechaFin,
					$descripcion){
			$this->idDescuento = $idDescuento;
			$this->porcentaje = $porcentaje;
			$this->estado = $estado;
			$this->fechaInicio = $fechaInicio;
			$this->fechaFin = $fechaFin;
			$this->descripcion = $descripcion;
		}
		public function getIdDescuento(){
			return $this->idDescuento;
		}
		public function setIdDescuento($idDescuento){
			$this->idDescuento = $idDescuento;
		}
		public function getPorcentaje(){
			return $this->porcentaje;
		}
		public function setPorcentaje($porcentaje){
			$this->porcentaje = $porcentaje;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
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
		public function __toString(){
			return "IdDescuento: " . $this->idDescuento . 
				" Porcentaje: " . $this->porcentaje . 
				" Estado: " . $this->estado . 
				" FechaInicio: " . $this->fechaInicio . 
				" FechaFin: " . $this->fechaFin . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>