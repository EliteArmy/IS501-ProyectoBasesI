<?php

	class TipoRecargo{

		private $idTipoRecargo;
		private $porcentaje;
		private $descripcion;
		private $idFactura;

		public function __construct($idTipoRecargo,
					$porcentaje,
					$descripcion,
					$idFactura){
			$this->idTipoRecargo = $idTipoRecargo;
			$this->porcentaje = $porcentaje;
			$this->descripcion = $descripcion;
			$this->idFactura = $idFactura;
		}
		public function getIdTipoRecargo(){
			return $this->idTipoRecargo;
		}
		public function setIdTipoRecargo($idTipoRecargo){
			$this->idTipoRecargo = $idTipoRecargo;
		}
		public function getPorcentaje(){
			return $this->porcentaje;
		}
		public function setPorcentaje($porcentaje){
			$this->porcentaje = $porcentaje;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getIdFactura(){
			return $this->idFactura;
		}
		public function setIdFactura($idFactura){
			$this->idFactura = $idFactura;
		}
		public function __toString(){
			return "IdTipoRecargo: " . $this->idTipoRecargo . 
				" Porcentaje: " . $this->porcentaje . 
				" Descripcion: " . $this->descripcion . 
				" IdFactura: " . $this->idFactura;
		}
	}
?>