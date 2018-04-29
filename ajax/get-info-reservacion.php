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
	 	
	 	case "obtener-precio":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Habitacion/class-reservacion.php");
			Reservacion::obtenerPrecio($conexion, $_POST["slc-categoria"], $_POST["slc-tipo"]);
	 	break;

	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>