<?php

	class Banco {

		private $idBanco;
		private $nombreBanco;

		public function __construct($idBanco,
					$nombreBanco){
			$this->idBanco = $idBanco;
			$this->nombreBanco = $nombreBanco;
		}
		public function getIdBanco(){
			return $this->idBanco;
		}
		public function setIdBanco($idBanco){
			$this->idBanco = $idBanco;
		}
		public function getNombreBanco(){
			return $this->nombreBanco;
		}
		public function setNombreBanco($nombreBanco){
			$this->nombreBanco = $nombreBanco;
		}
		public function toString(){
			return "IdBanco: " . $this->idBanco . 
				" NombreBanco: " . $this->nombreBanco;
		}
	}
?>