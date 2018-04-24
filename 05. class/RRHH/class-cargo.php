<?php

	class Cargo {

		private $idCargo;
		private $nombreCargo;
		private $salarioMinimo;
		private $salarioMaximo;
		private $estado;

		public function __construct($idCargo,
					$nombreCargo,
					$salarioMinimo,
					$salarioMaximo,
					$estado){
			$this->idCargo = $idCargo;
			$this->nombreCargo = $nombreCargo;
			$this->salarioMinimo = $salarioMinimo;
			$this->salarioMaximo = $salarioMaximo;
			$this->estado = $estado;
		}
		public function getIdCargo(){
			return $this->idCargo;
		}
		public function setIdCargo($idCargo){
			$this->idCargo = $idCargo;
		}
		public function getNombreCargo(){
			return $this->nombreCargo;
		}
		public function setNombreCargo($nombreCargo){
			$this->nombreCargo = $nombreCargo;
		}
		public function getSalarioMinimo(){
			return $this->salarioMinimo;
		}
		public function setSalarioMinimo($salarioMinimo){
			$this->salarioMinimo = $salarioMinimo;
		}
		public function getSalarioMaximo(){
			return $this->salarioMaximo;
		}
		public function setSalarioMaximo($salarioMaximo){
			$this->salarioMaximo = $salarioMaximo;
		}
		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}
		public function __toString(){
			return "IdCargo: " . $this->idCargo . 
				" NombreCargo: " . $this->nombreCargo . 
				" SalarioMinimo: " . $this->salarioMinimo . 
				" SalarioMaximo: " . $this->salarioMaximo . 
				" Estado: " . $this->estado;
		}
	}
?>