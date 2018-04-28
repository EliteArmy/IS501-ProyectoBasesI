<?php

	class TipoFactura{

		private $idTipoFactua;
		private $nombre;
		private $descripcion;

		public function __construct($idTipoFactua,
					$nombre,
					$descripcion){
			$this->idTipoFactua = $idTipoFactua;
			$this->nombre = $nombre;
			$this->descripcion = $descripcion;
		}
		public function getIdTipoFactua(){
			return $this->idTipoFactua;
		}
		public function setIdTipoFactua($idTipoFactua){
			$this->idTipoFactua = $idTipoFactua;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function __toString(){
			return "IdTipoFactua: " . $this->idTipoFactua . 
				" Nombre: " . $this->nombre . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>