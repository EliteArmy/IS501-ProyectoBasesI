<?php

	class Habitacion_Reservacion{

		private $idHabitacion;
		private $idReservacion;

		public function __construct($idHabitacion,
					$idReservacion){
			$this->idHabitacion = $idHabitacion;
			$this->idReservacion = $idReservacion;
		}
		public function getIdHabitacion(){
			return $this->idHabitacion;
		}
		public function setIdHabitacion($idHabitacion){
			$this->idHabitacion = $idHabitacion;
		}
		public function getIdReservacion(){
			return $this->idReservacion;
		}
		public function setIdReservacion($idReservacion){
			$this->idReservacion = $idReservacion;
		}
		public function __toString(){
			return "IdHabitacion: " . $this->idHabitacion . 
				" IdReservacion: " . $this->idReservacion;
		}
		
	}
?>