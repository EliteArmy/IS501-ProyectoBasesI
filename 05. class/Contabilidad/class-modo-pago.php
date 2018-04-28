<?php

	class ModoPago {

		private $idModoPago;
		private $modoPago;
		private $descripcion;

		public function __construct($idModoPago,
					$modoPago,
					$descripcion){
			$this->idModoPago = $idModoPago;
			$this->modoPago = $modoPago;
			$this->descripcion = $descripcion;
		}
		public function getIdModoPago(){
			return $this->idModoPago;
		}
		public function setIdModoPago($idModoPago){
			$this->idModoPago = $idModoPago;
		}
		public function getModoPago(){
			return $this->modoPago;
		}
		public function setModoPago($modoPago){
			$this->modoPago = $modoPago;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function __toString(){
			return "IdModoPago: " . $this->idModoPago . 
				" ModoPago: " . $this->modoPago . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>