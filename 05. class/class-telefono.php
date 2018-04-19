<?php

	class Telefono {

		private $idTelefono;
		private $numeroTelefono;

		public function __construct(
					$idTelefono,
					$numeroTelefono){
			$this->idTelefono = $idTelefono;
			$this->numeroTelefono = $numeroTelefono;
		}
		public function getIdTelefono(){
			return $this->idTelefono;
		}
		public function setIdTelefono($idTelefono){
			$this->idTelefono = $idTelefono;
		}

		public function getNumeroTelefono(){
			return $this->numeroTelefono;
		}
		public function setNumeroTelefono($numeroTelefono){
			$this->numeroTelefono = $numeroTelefono;
		}

		public function __toString(){
			return "IdTelefono: " . $this->idTelefono . 
				" NumeroTelefono: " . $this->numeroTelefono;
		}
		
	}
?>