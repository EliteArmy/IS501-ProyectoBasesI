<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "registrar-cliente":
			//echo "Entra en el case ";
	 		include ("../05. class/class-cliente.php");
			Cliente::registrarCliente($conexion);
	 	break;
	 	
	 	case "registrar-empleado":
	 		//echo "Entra en el case ";
	 		include ("../05. class/class-empleado.php");
			Empleado::registrarEmpleado($conexion);
	 	break;

	 	case "registrar-reservacion":
			//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::registrarReservacion($conexion);
	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>