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
		public static function verificarUsuario($conexion, $email, $password){
			
			// Convierte la contraseña en Hash para que pueda ser evaluada en la base
			$passwordHash = md5($password);

			// Consulta para verficar que el Usuario es un Empleado
			$resultado = $conexion->ejecutarConsulta (
				"SELECT emp.idEmpleado, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, per.email, per.password, per.genero, per.direccion, per.fechaNacimiento, per.imagenIdentificacion, emp.estado, tel.numeroTelefono
				FROM Persona per
				INNER JOIN empleado emp ON (per.idPersona = emp.idPersona) 
				INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
				WHERE per.email = '$email' AND per.password = '$passwordHash'
			");

			$cantidadRegistros = $conexion->cantidadRegistros($resultado); // Indica la cantidad de registros encontrados
			$respuesta = array();
			$usuario = 'empleado';

			if ($cantidadRegistros == 0){

				// Consulta para verificar que el Usuario es un Cliente
				$resultado = $conexion->ejecutarConsulta (
					"SELECT cli.idCliente, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, per.email, per.password, per.genero, per.direccion, per.fechaNacimiento, per.imagenIdentificacion, cli.estado, tel.numeroTelefono
					FROM Persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
					WHERE per.email = '$email' AND per.password = '$passwordHash'
				");

				$cantidadRegistros = $conexion->cantidadRegistros($resultado); // Indica la cantidad de registros encontrados
				$usuario = 'cliente';

			} 

			// $cantidadRegistros == 1, significa que encontro un registro en la Base
			if ($cantidadRegistros == 1) {

				$fila = $conexion->obtenerFila($resultado);
				if($usuario == 'empleado'){
					$_SESSION["idEmpleado"] = $fila["idEmpleado"];
					$_SESSION["permiso"] = "trabajador";
					$respuesta["status"] = 1;
				} else {
					$_SESSION["idCliente"] = $fila["idCliente"];
					$_SESSION["permiso"] = "cliente";
					$respuesta["status"] = 2;

				}

				$_SESSION["primerNombre"] = $fila["primerNombre"];
				$_SESSION["segundoNombre"] = $fila["segundoNombre"];
				$_SESSION["primerApellido"] = $fila["primerApellido"];
				$_SESSION["segundoApellido"] = $fila["segundoApellido"];
				$_SESSION["email"] = $fila["email"];
				$_SESSION["genero"] = $fila["genero"];
				$_SESSION["direccion"] = $fila["direccion"];
				$_SESSION["fechaNacimiento"] = $fila["fechaNacimiento"];
				$_SESSION["imagenIdentificacion"] = $fila["imagenIdentificacion"];
				$_SESSION["numeroTelefono"] = $fila["numeroTelefono"];

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