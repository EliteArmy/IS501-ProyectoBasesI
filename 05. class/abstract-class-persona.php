<?php

	abstract class Persona {

		protected $idPersona;
		protected $primerNombre;
		protected $segundoNombre;
		protected $primerApellido;
		protected $segundoApellido;
		protected $email;
		protected $password;
		protected $genero;
		protected $direccion;
		protected $fechaNacimiento;
		protected $imagenIdentificacion;

		public function __construct(
					$idPersona,
					$primerNombre,
					$segundoNombre,
					$primerApellido,
					$segundoApellido,
					$email,
					$password,
					$genero,
					$direccion,
					$fechaNacimiento,
					$imagenIdentificacion) {
			$this->idPersona = $idPersona;
			$this->primerNombre = $primerNombre;
			$this->segundoNombre = $segundoNombre;
			$this->primerApellido = $primerApellido;
			$this->segundoApellido = $segundoApellido;
			$this->email = $email;
			$this->password = $password;
			$this->genero = $genero;
			$this->direccion = $direccion;
			$this->fechaNacimiento = $fechaNacimiento;
			$this->imagenIdentificacion = $imagenIdentificacion;
		}
		
		public function getIdPersona(){
			return $this->idPersona;
		}
		public function setIdPersona($idPersona){
			$this->idPersona = $idPersona;
		}

		public function getPrimerNombre(){
			return $this->primerNombre;
		}
		public function setPrimerNombre($primerNombre){
			$this->primerNombre = $primerNombre;
		}

		public function getSegundoNombre(){
			return $this->segundoNombre;
		}
		public function setSegundoNombre($segundoNombre){
			$this->segundoNombre = $segundoNombre;
		}

		public function getPrimerApellido(){
			return $this->primerApellido;
		}
		public function setPrimerApellido($primerApellido){
			$this->primerApellido = $primerApellido;
		}

		public function getSegundoApellido(){
			return $this->segundoApellido;
		}
		public function setSegundoApellido($segundoApellido){
			$this->segundoApellido = $segundoApellido;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}

		public function getPassword(){
			return $this->password;
		}
		public function setPassword($password){
			$this->password = $password;
		}

		public function getGenero(){
			return $this->genero;
		}
		public function setGenero($genero){
			$this->genero = $genero;
		}

		public function getDireccion(){
			return $this->direccion;
		}
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}

		public function getFechaNacimiento(){
			return $this->fechaNacimiento;
		}
		public function setFechaNacimiento($fechaNacimiento){
			$this->fechaNacimiento = $fechaNacimiento;
		}

		public function getImagenIdentificacion(){
			return $this->imagenIdentificacion;
		}
		public function setImagenIdentificacion($imagenIdentificacion){
			$this->imagenIdentificacion = $imagenIdentificacion;
		}

		public function __toString(){
			return "IdPersona: " . $this->idPersona . 
				" PrimerNombre: " . $this->primerNombre . 
				" SegundoNombre: " . $this->segundoNombre . 
				" PrimerApellido: " . $this->primerApellido . 
				" SegundoApellido: " . $this->segundoApellido . 
				" Email: " . $this->email . 
				" Password: " . $this->password . 
				" Genero: " . $this->genero . 
				" Direccion: " . $this->direccion . 
				" FechaNacimiento: " . $this->fechaNacimiento . 
				" ImagenIdentificacion: " . $this->imagenIdentificacion;
		}
		
	}
?>