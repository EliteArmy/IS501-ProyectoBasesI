<?php

	class PagoPlanilla{

		private $idPagoPlanilla;
		private $montoPagado;
		private $valorBonificacion;
		private $valorImpuesto;
		private $valorDeduccion;
		private $observacion;
		private $idEmpleado;
		private $idEncabezadoPlanilla;

		public function __construct($idPagoPlanilla,
					$montoPagado,
					$valorBonificacion,
					$valorImpuesto,
					$valorDeduccion,
					$observacion,
					$idEmpleado,
					$idEncabezadoPlanilla){
			$this->idPagoPlanilla = $idPagoPlanilla;
			$this->montoPagado = $montoPagado;
			$this->valorBonificacion = $valorBonificacion;
			$this->valorImpuesto = $valorImpuesto;
			$this->valorDeduccion = $valorDeduccion;
			$this->observacion = $observacion;
			$this->idEmpleado = $idEmpleado;
			$this->idEncabezadoPlanilla = $idEncabezadoPlanilla;
		}
		public function getIdPagoPlanilla(){
			return $this->idPagoPlanilla;
		}
		public function setIdPagoPlanilla($idPagoPlanilla){
			$this->idPagoPlanilla = $idPagoPlanilla;
		}
		public function getMontoPagado(){
			return $this->montoPagado;
		}
		public function setMontoPagado($montoPagado){
			$this->montoPagado = $montoPagado;
		}
		public function getValorBonificacion(){
			return $this->valorBonificacion;
		}
		public function setValorBonificacion($valorBonificacion){
			$this->valorBonificacion = $valorBonificacion;
		}
		public function getValorImpuesto(){
			return $this->valorImpuesto;
		}
		public function setValorImpuesto($valorImpuesto){
			$this->valorImpuesto = $valorImpuesto;
		}
		public function getValorDeduccion(){
			return $this->valorDeduccion;
		}
		public function setValorDeduccion($valorDeduccion){
			$this->valorDeduccion = $valorDeduccion;
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
		public function getIdEncabezadoPlanilla(){
			return $this->idEncabezadoPlanilla;
		}
		public function setIdEncabezadoPlanilla($idEncabezadoPlanilla){
			$this->idEncabezadoPlanilla = $idEncabezadoPlanilla;
		}
		public function __toString(){
			return "IdPagoPlanilla: " . $this->idPagoPlanilla . 
				" MontoPagado: " . $this->montoPagado . 
				" ValorBonificacion: " . $this->valorBonificacion . 
				" ValorImpuesto: " . $this->valorImpuesto . 
				" ValorDeduccion: " . $this->valorDeduccion . 
				" Observacion: " . $this->observacion . 
				" IdEmpleado: " . $this->idEmpleado . 
				" IdEncabezadoPlanilla: " . $this->idEncabezadoPlanilla;
		}
	}
?>