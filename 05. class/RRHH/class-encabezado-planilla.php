<?php

	class EncabezadoPlanilla{

		private $idEncabezadoPlanilla;
		private $fechaInicio;
		private $fechaFin;
		private $observacion;
		private $idEmpleado;

		public function __construct($idEncabezadoPlanilla,
					$fechaInicio,
					$fechaFin,
					$observacion,
					$idEmpleado){
			$this->idEncabezadoPlanilla = $idEncabezadoPlanilla;
			$this->fechaInicio = $fechaInicio;
			$this->fechaFin = $fechaFin;
			$this->observacion = $observacion;
			$this->idEmpleado = $idEmpleado;
		}
		public function getIdEncabezadoPlanilla(){
			return $this->idEncabezadoPlanilla;
		}
		public function setIdEncabezadoPlanilla($idEncabezadoPlanilla){
			$this->idEncabezadoPlanilla = $idEncabezadoPlanilla;
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
		public function getObservacion(){
			return $this->observacion;
		}
		public function setObservacion($observacion){
			$this->observacion = $observacion;
		}
		public function getIdEmpleado(){
			return $this->idEmpleado;
		}
		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}
		public function __toString(){
			return "IdEncabezadoPlanilla: " . $this->idEncabezadoPlanilla . 
				" FechaInicio: " . $this->fechaInicio . 
				" FechaFin: " . $this->fechaFin . 
				" Observacion: " . $this->observacion . 
				" IdEmpleado: " . $this->idEmpleado;
		}
	}
?>