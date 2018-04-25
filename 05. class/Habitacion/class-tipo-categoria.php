<?php

	class TipoCategoria{

		private $idTipoCategoria;
		private $tipoCategoria;
		private $descripcion;

		public function __construct(
					$idTipoCategoria,
					$tipoCategoria,
					$descripcion){
			$this->idTipoCategoria = $idTipoCategoria;
			$this->tipoCategoria = $tipoCategoria;
			$this->descripcion = $descripcion;
		}

		public function getIdTipoCategoria(){
			return $this->idTipoCategoria;
		}
		public function setIdTipoCategoria($idTipoCategoria){
			$this->idTipoCategoria = $idTipoCategoria;
		}

		public function getTipoCategoria(){
			return $this->tipoCategoria;
		}
		public function setTipoCategoria($tipoCategoria){
			$this->tipoCategoria = $tipoCategoria;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function __toString(){
			return "IdTipoCategoria: " . $this->idTipoCategoria . 
				" TipoCategoria: " . $this->tipoCategoria . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>