<?php

	class Impuesto{

		private $idImpuesto;
		private $porcecntaje;
		private $estado;
		private $fechaInicio;
		private $fechaFin;
		private $descripcion;

		public function __construct($idImpuesto,
					$porcecntaje,
					$estado,
					$fechaInicio,
					$fechaFin,
					$descripcion){
			$this->idImpuesto = $idImpuesto;
			$this->porcecntaje = $porcecntaje;
			$this->estado = $estado;
			$this->fechaInicio = $fechaInicio;
			$this->fechaFin = $fechaFin;
			$this->descripcion = $descripcion;
		}
		public function getIdImpuesto(){
			return $this->idImpuesto;
		}
		public function setIdImpuesto($idImpuesto){
			$this->idImpuesto = $idImpuesto;
		}
		public function getPorcecntaje(){
			return $this->porcecntaje;
		}
		public function setPorcecntaje($porcecntaje){
			$this->porcecntaje = $porcecntaje;
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
			return "IdImpuesto: " . $this->idImpuesto . 
				" Porcecntaje: " . $this->porcecntaje . 
				" Estado: " . $this->estado . 
				" FechaInicio: " . $this->fechaInicio . 
				" FechaFin: " . $this->fechaFin . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>