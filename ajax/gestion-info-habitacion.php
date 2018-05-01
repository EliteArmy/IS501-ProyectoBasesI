<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "registrar-habitacion":
			//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-habitacion.php");

	 		$habitacion = new Habitacion(
	 				null,
	 				$_POST["txtreg-numero-hab"],
	 				$_POST["txtreg-numero-piso"],
		 			$_POST["txtreg-estado"],
		 			$_POST["txtreg-descripcion"],
		 			$_POST["slcreg-tipoCategoria"],
		 			$_POST["slcreg-tipoHabitacion"],
		 			$_POST["slcreg-sucursal"]);

			$habitacion->registrarHabitacion($conexion);

	 	break;

	 	case "actualizar-habitacion":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-habitacion.php");

	 		$habitacion = new Habitacion(
	 				$_POST["txt-idHabitacion"],
	 				$_POST["txt-numero-hab"],
	 				$_POST["txt-numero-piso"],
		 			$_POST["txt-estado"],
		 			$_POST["txt-descripcion"],
		 			$_POST["slc-tipoCategoria"],
		 			$_POST["slc-tipoHabitacion"],
		 			$_POST["slc-sucursal"]);


	 		$habitacion->actualizarHabitacion($conexion);
	 	break;
	 	
	 	case "eliminar-habitacion":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-habitacion.php");
			Habitacion::eliminarHabitacion($conexion, $_POST["idHabitacion"]);

	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>