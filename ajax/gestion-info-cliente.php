<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){
		/*
		case "":
			//echo "Entra en el case ";
	 		include ("../05. class/class-cliente.php");
			Cliente::nombreFuncion($conexion);
			echo "Mensaje";
	 	break;
	 	*/
	 	case "registrar-cliente":

	 		//echo "Entra en el case ";
	 		include ("../05. class/class-cliente.php");
	 		include ("../05. class/class-telefono.php");

	 		$cliente = new Cliente(
	 			null, //idPersona
	 			$_POST["txtreg-primer-nombre"],
	 			$_POST["txtreg-segundo-nombre"],
	 			$_POST["txtreg-primer-apellido"],
	 			$_POST["txtreg-segundo-apellido"],
	 			$_POST["txtreg-email"],
	 			$_POST["txtreg-password"],
	 			$_POST["slcreg-genero"],
	 			$_POST["txtreg-direccion"],
	 			$_POST["txtreg-fecha-nacimiento"],
	 			null, //imagenIdentificacion

	 			null, //idCliente
	 			null, //fechaRegistro
	 			$_POST["slcreg-estado"], 

	 			new Telefono(null, $_POST["txtreg-telefono"], null)); //idTelefono, numeroTelefono, idPersona

	 		$cliente->registrarCliente($conexion);

	 	break;
		
	 	case "actualizar-cliente":

	 		//include("../05. class/abstract-class-persona.php");
	 		include("../05. class/class-cliente.php");
	 		include("../05. class/class-telefono.php");

	 		$cliente = new Cliente(
				$_POST["txt-idcliente"],
				$_POST["txt-primer-nombre"],
				$_POST["txt-segundo-nombre"],
				$_POST["txt-primer-apellido"],
				$_POST["txt-segundo-apellido"],
				$_POST["txt-email"],
				null, // password
				null, // genero
				$_POST["txt-direccion"],
				$_POST["txt-fecha-nacimiento"],
				null, // imagenIdentificacion

				$_POST["idCliente"],
				null, //fechaRegistro
				$_POST["slc-estado"],

				new Telefono(null, $_POST["txt-telefono"], null) //idTelefono, numeroTelefono, idPersona
			);

			$cliente->actualizarCliente($conexion);
			//$cliente->actualizarCliente($conexion, $_POST["idPersona"]);
			//Cliente::actualizarCliente($conexion, $_POST["idPersona"]);
		break;	 	

		case "eliminar-cliente":
	 		//echo "Entra en el case Eliminar Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::eliminarCliente($conexion, $_POST["idCliente"]);
			//echo "Registro de Cliente Eliminado";
	 	break;
		
		default:
	 		echo "Accion Invalida";
	 	break;

	 }

	 $conexion->cerrarConexion();
?>