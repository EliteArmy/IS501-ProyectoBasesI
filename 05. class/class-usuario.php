<?php

	include_once ("abstract-class-persona.php");

	class Usuario extends Persona {

		protected $telefono;

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
				$imagenIdentificacion,

				$telefono) {
			parent::__construct(
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
					$imagenIdentificacion);

			$this->telefono = $telefono;
		}

		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function __toString(){
			return parent::__toString() . " Telefono: " . $this->telefono;
		}

		// --- Función que Valida si existe un Usuario en la Base ---
		public static function verificarUsuario($conexion, $email, $password, $tipoUsuario){
				
			$resultado = $conexion->ejecutarConsulta (
				"SELECT per.idPersona, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, per.email, per.password, per.genero, per.direccion, per.fechaNacimiento, per.imagenIdentificacion
				FROM Persona per
				WHERE per.email = '$email' AND per.passworod = '$password'
			");

			$cantidadRegistros = $conexion->cantidadRegistros($resultado);

			$respuesta = array();
				
			if ($cantidadRegistros == 1){

				$fila = $conexion->obtenerFila($resultado);

				$_SESSION["idCliente"] = $fila["idCliente"];
				$_SESSION["primerNombre"] = $fila["primerNombre"];
				$_SESSION["segundoNombre"] = $fila["segundoNombre"];
				$_SESSION["primerApellido"] = $fila["primerApellido"];
				$_SESSION["segundoApellido"] = $fila["segundoApellido"];
				$_SESSION["email"] = $fila["email"];
				$_SESSION["genero"] = $fila["genero"];
				$_SESSION["direccion"] = $fila["direccion"];
				$_SESSION["fechaNacimiento"] = $fila["fechaNacimiento"];
				$_SESSION["imagenIdentificacion"] = $fila["imagenIdentificacion"];
				
				$respuesta["status"] = 1;
				$respuesta["mensaje"] = "Si tiene acceso";

			} else {

				$respuesta["status"] = 0;
				$respuesta["mensaje"] = "No tiene acceso";
			}

			echo json_encode($respuesta);
		}

		// --- Función Futura ---
		public static function nombreFuncion2($conexion){

		}


	}
?>