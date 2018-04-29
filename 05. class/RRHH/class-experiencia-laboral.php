<?php

	class ExperienciaLaboral{

		private $idExperienciaLaboral;
		private $titulo;
		private $fechaNacimiento;
		private $fechaFin;
		private $descripcion;
		private $idEmpleado;

		public function __construct($idExperienciaLaboral,
					$titulo,
					$fechaNacimiento,
					$fechaFin,
					$descripcion,
					$idEmpleado){
			$this->idExperienciaLaboral = $idExperienciaLaboral;
			$this->titulo = $titulo;
			$this->fechaNacimiento = $fechaNacimiento;
			$this->fechaFin = $fechaFin;
			$this->descripcion = $descripcion;
			$this->idEmpleado = $idEmpleado;
		}
		public function getIdExperienciaLaboral(){
			return $this->idExperienciaLaboral;
		}
		public function setIdExperienciaLaboral($idExperienciaLaboral){
			$this->idExperienciaLaboral = $idExperienciaLaboral;
		}
		public function getTitulo(){
			return $this->titulo;
		}
		public function setTitulo($titulo){
			$this->titulo = $titulo;
		}
		public function getFechaNacimiento(){
			return $this->fechaNacimiento;
		}
		public function setFechaNacimiento($fechaNacimiento){
			$this->fechaNacimiento = $fechaNacimiento;
		}
		public function getFechaFin(){
			return $this->fechaFin;
		}
		public function setFechaFin($fechaFin){
			$this->fechaFin = $fechaFin;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getIdEmpleado(){
			return $this->idEmpleado;
		}
		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}
		public function __toString(){
			return "IdExperienciaLaboral: " . $this->idExperienciaLaboral . 
				" Titulo: " . $this->titulo . 
				" FechaNacimiento: " . $this->fechaNacimiento . 
				" FechaFin: " . $this->fechaFin . 
				" Descripcion: " . $this->descripcion . 
				" IdEmpleado: " . $this->idEmpleado;
		}
	}
?>