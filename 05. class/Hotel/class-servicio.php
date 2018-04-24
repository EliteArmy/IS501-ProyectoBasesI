<?php

	class Servicio {

		private $idServicio;
		private $tipoServicio;
		private $descripcion;

		public function __construct(
					$idServicio,
					$tipoServicio,
					$descripcion){
			$this->idServicio = $idServicio;
			$this->tipoServicio = $tipoServicio;
			$this->descripcion = $descripcion;
		}
		public function getIdServicio(){
			return $this->idServicio;
		}
		public function setIdServicio($idServicio){
			$this->idServicio = $idServicio;
		}

		public function getTipoServicio(){
			return $this->tipoServicio;
		}
		public function setTipoServicio($tipoServicio){
			$this->tipoServicio = $tipoServicio;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function __toString(){
			return "IdServicio: " . $this->idServicio . 
				" TipoServicio: " . $this->tipoServicio . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>