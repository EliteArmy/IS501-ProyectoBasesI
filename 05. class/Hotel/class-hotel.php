<?php

	class Hotel {

		private $idHotel;
		private $descripcion;

		public function __construct($idHotel,
					$descripcion){
			$this->idHotel = $idHotel;
			$this->descripcion = $descripcion;
		}
		public function getIdHotel(){
			return $this->idHotel;
		}
		public function setIdHotel($idHotel){
			$this->idHotel = $idHotel;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function __toString(){
			return "IdHotel: " . $this->idHotel . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>