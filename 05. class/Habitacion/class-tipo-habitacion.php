<?php

	class TipoHabitacion {

		private $idTipoHabitacion;
		private $tipoHabitacion;
		private $descripcion;

		public function __construct($idTipoHabitacion,
					$tipoHabitacion,
					$descripcion){
			$this->idTipoHabitacion = $idTipoHabitacion;
			$this->tipoHabitacion = $tipoHabitacion;
			$this->descripcion = $descripcion;
		}

		public function getIdTipoHabitacion(){
			return $this->idTipoHabitacion;
		}
		public function setIdTipoHabitacion($idTipoHabitacion){
			$this->idTipoHabitacion = $idTipoHabitacion;
		}

		public function getTipoHabitacion(){
			return $this->tipoHabitacion;
		}
		public function setTipoHabitacion($tipoHabitacion){
			$this->tipoHabitacion = $tipoHabitacion;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function __toString(){
			return "IdTipoHabitacion: " . $this->idTipoHabitacion . 
				" TipoHabitacion: " . $this->tipoHabitacion . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>