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
	 	
	 	case "":
	 		//echo "Entra en el case ";
	 		include ("../05. class/class-cliente.php");
			Cliente::nombreFuncion($conexion);
			echo "Mensaje";
	 	break;
		*/
	 	
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
			//$cliente->actualizarCliente($conexion, $_POST["idCliente"]);
			//Cliente::actualizarCliente($conexion, $_POST["idpersona"]);
		break;	 	

		case "eliminar-cliente":
	 		//echo "Entra en el case Eliminar Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::eliminarCliente($conexion, $_POST["idPersona"]);
			//echo "Registro de Cliente Eliminado";
	 	break;
		
		default:
	 		echo "Accion Invalida";
	 	break;

	 }

	 $conexion->cerrarConexion();
?>