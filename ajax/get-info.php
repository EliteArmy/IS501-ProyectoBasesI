<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "obtener-clientes":
			//echo "Entra en el case Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::obtenerListaClientes($conexion);

	 	break;
	 	
	 	case "obtener-empleados":
	 		//echo "Entra en el case Empleado";
	 		include ("../05. class/class-empleado.php");
			Empleado::obtenerListaEmpleados($conexion);

	 	break;
	 	
	 	case "obtener-facturas":
	 		//echo "Entra en el case Factura";
			include("../05. class/class-factura.php"); 
			Factura::obtenerListaFacturas($conexion);		
	 	break;

	 	case "obtener-sucursales":
	 		//echo "Entra en el case Sucursal";
	 		include("../05. class/class-sucursal.php"); 
	 		Sucursal::obtenerListaSucursales($conexion);
	 	break;

	 	case "obtener-habitaciones":
	 		//echo "Entra en el case Habitacion";
	 		include("../05. class/class-habitacion.php"); 
	 		Habitacion::obtenerListaHabitaciones($conexion);
	 	break;

		/*
	 	case "obtener-aplicacion":
	 		include("../class/class-aplicacion.php"); 
	 		Aplicacion::obtenerDetalleAplicaciones($conexion, $_POST["codigo-aplicacion"]);	 		
	 	break;
		*/
		
	 	default:
	 		echo "Accion invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>