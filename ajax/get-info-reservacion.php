<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "obtener-categorias":
			//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::obtenerListaCategorias($conexion);
	 	break;
	 	
	 	case "obtener-tipos":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::obtenerListaTipos($conexion);
	 	break;

	 	case "obtener-sucursal":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::obtenerListaSucursal($conexion);
	 	break;

	 	case "obtener-precio":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::obtenerPrecio($conexion, $_POST["slc-categoria"], $_POST["slc-tipo"]);
	 	break;

	 	case "obtener-habitacion":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::obtenerHabitacion($conexion, $_POST["slc-sucursal"]);
	 	break;

	 	case "obtener-detalle-cliente":
	 		//echo "Entra en el case Obtener detalle cliente";
	 		include ("../05. class/Habitacion/class-reservacion.php");
	 		Reservacion::obtenerDetalleCliente($conexion, $_POST["correoCliente"]);
		break;

	 	case "registrar-reservacion":
	 		//echo "Entra en el case registrar reservacion";
	 		include ("../05. class/Habitacion/class-reservacion.php");

	 		$reservacion = new Reservacion(
	 			null, //idReservacion
	 			null, //fechaReservacion
	 			$_POST["txt-fecha-entrada"], //fechaEntrada
	 			$_POST["txt-fecha-salid"], //fechaSalida
	 			$_POST["slc-supletoria"], //camaSupletoria
	 			$_POST["slc-estado"], //estado
	 			$_POST["txt-observacion"], //observacion
	 			$_POST["slc-adultos"], //$noAdultos
	 			$_POST["slc-ninos"], //noNinos
	 			$_POST["txt-idcliente"]  //idCliente
	 		);

	 		$reservacion->registrarReservacion($conexion);

		break;

	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>
