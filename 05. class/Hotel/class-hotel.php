<?php

	class Hotel {

		private $idHotel;
		private $descripcionHotel;

		public function __construct($idHotel,
					$descripcion){
			$this->idHotel = $idHotel;
			$this->descripcionHotel = $descripcionHotel;
		}
		public function getIdHotel(){
			return $this->idHotel;
		}
		public function setIdHotel($idHotel){
			$this->idHotel = $idHotel;
		}
		public function getDescripcionHotel(){
			return $this->descripcionHotel;
		}
		public function setDescripcionHotel($descripcionHotel){
			$this->descripcionHotel = $descripcionHotel;
		}
		public function __toString(){
			return "IdHotel: " . $this->idHotel . 
				" Descripcion: " . $this->descripcionHotel;
		}
	}
?>