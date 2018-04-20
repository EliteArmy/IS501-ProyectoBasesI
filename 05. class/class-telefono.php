<?php

	class Telefono {

		private $idTelefono;
		private $numeroTelefono;
		private $idPersona;

		public function __construct(
					$idTelefono,
					$numeroTelefono,
					$idPersona){
			$this->idTelefono = $idTelefono;
			$this->numeroTelefono = $numeroTelefono;
			$this->idPersona = $idPersona;
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

		public function getIdPersona(){
			return $this->idPersona;
		}
		public function setIdPersona($idPersona){
			$this->idPersona = $idPersona;
		}

		public function __toString(){
			return "IdTelefono: " . $this->idTelefono . 
				" NumeroTelefono: " . $this->numeroTelefono . 
				" IdPersona: " . $this->idPersona;
		}

	}
?>