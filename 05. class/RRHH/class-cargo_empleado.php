<?php

	class CargoEmpleado{

		private $idCargo;
		private $idEmpleado;

		public function __construct($idCargo,
					$idEmpleado){
			$this->idCargo = $idCargo;
			$this->idEmpleado = $idEmpleado;
		}
		public function getIdCargo(){
			return $this->idCargo;
		}

		public function setIdCargo($idCargo){
			$this->idCargo = $idCargo;
		}
		public function getIdEmpleado(){
			return $this->idEmpleado;
		}

		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}
		public function __toString(){
			return "IdCargo: " . $this->idCargo . 
				" IdEmpleado: " . $this->idEmpleado;
		}
	}
?>