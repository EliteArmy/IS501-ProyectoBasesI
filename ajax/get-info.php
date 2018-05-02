<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		/* -- Informacion de Clientes --*/
		case "obtener-clientes":
			//echo "Entra en el case Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::obtenerListaClientes($conexion);
	 	break;

		case "obtener-clientes2":
			//echo "Entra en el case Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::obtenerListaClientes2($conexion);
	 	break;
	 	
	 	case "obtener-detalle-cliente":
	 	//echo "Entra en el case Obtener Cliente";
	 		include ("../05. class/class-cliente.php"); 
	 		Cliente::obtenerDetalleCliente($conexion, $_POST["idCliente"]);	 		
	 	break;


	 	/* -- Informacion de Empleados --*/
	 	case "obtener-empleados":
	 		//echo "Entra en el case Empleado";
	 		include ("../05. class/class-empleado.php");
			Empleado::obtenerListaEmpleados($conexion);
	 	break;

	 	case "obtener-empleados2":
	 		//echo "Entra en el case Empleado";
	 		include ("../05. class/class-empleado.php");
			Empleado::obtenerListaEmpleados2($conexion);
	 	break;

	 	case "obtener-detalle-empleado":
	 		//echo "Entra en el case Obtener Empleado";
	 		include ("../05. class/class-empleado.php");
	 		Empleado::obtenerDetalleEmpleado($conexion, $_POST["idEmpleado"]);
		break;

		case "obtener-sucursales-empleado":
	 		//echo "Entra en el case Empleado";
	 		include ("../05. class/class-empleado.php");
	 		Empleado::obtenerSucursalesEmpleado($conexion);
		break;


	 	/* -- Informacion de Facturas --*/
	 	case "obtener-facturas":
	 		//echo "Entra en el case Factura";
			include ("../05. class/Contabilidad/class-factura.php"); 
			Factura::obtenerListaFacturas($conexion);		
	 	break;

	 	case "obtener-cliente-factura":
	 		//echo "Entra en el case Factura";
			include ("../05. class/Contabilidad/class-factura.php"); 
			Factura::obtenerClienteFactura($conexion);		
	 	break;

	 	case "obtener-empleado-factura":
	 		//echo "Entra en el case Factura";
			include ("../05. class/Contabilidad/class-factura.php"); 
			Factura::obtenerEmpleadoFactura($conexion);		
	 	break;

	 	case "obtener-tipoFactura-factura":
	 		//echo "Entra en el case Factura";
			include ("../05. class/Contabilidad/class-factura.php"); 
			Factura::obtenerTipoFacFactura($conexion);		
	 	break;

	 	case "obtener-modoPago-factura":
	 		//echo "Entra en el case Factura";
			include ("../05. class/Contabilidad/class-factura.php"); 
			Factura::obtenerModoPagoFactura($conexion);		
	 	break;


	 	/* -- Informacion de Sucursales --*/
	 	case "obtener-sucursales":
	 		//echo "Entra en el case Sucursal";
	 		include ("../05. class/Hotel/class-sucursal.php"); 
	 		Sucursal::obtenerListaSucursales($conexion);
	 	break;


	 	/* -- Informacion de Habitaciones --*/
	 	case "obtener-habitaciones":
	 		//echo "Entra en el case Habitacion";
	 		include ("../05. class/Habitacion/class-habitacion.php"); 
	 		Habitacion::obtenerListaHabitaciones($conexion);
	 	break;

	 	case "obtener-habitaciones2":
	 		//echo "Entra en el case Habitacion";
	 		include ("../05. class/Habitacion/class-habitacion.php"); 
	 		Habitacion::obtenerListaHabitaciones2($conexion);
	 	break;

	 	case "obtener-detalle-habitacion":
	 		include ("../05. class/Habitacion/class-habitacion.php");
	 		Habitacion::obtenerDetalleHabitacion($conexion, $_POST["idHabitacion"]);
		break;

	 	case "obtener-sucursales-habitacion":
	 		//echo "Entra en el case Empleado";
	 		include ("../05. class/Habitacion/class-habitacion.php");
	 		Habitacion::obtenerSucursalesHabitacion($conexion);
		break;

		case "obtener-tipoCategoria-habitacion";
			include ("../05. class/Habitacion/class-habitacion.php");
			Habitacion::obtenerTipoCategoriaHabitacion($conexion);
		break;

		case "obtener-tipoHabitacion-habitacion";
			include ("../05. class/Habitacion/class-habitacion.php");
			Habitacion::obtenerTipoHabHabitacion($conexion);
		break;
		
		case "obtener-detalle-sucursal":
	 	//echo "Entra en el case Obtener Cliente";
	 		include ("../05. class/Hotel/class-sucursal.php"); 
	 		Sucursal::obtenerDetalleSucursal($conexion, $_POST["idSucursal"]);	 		
	 	break;

	 	case "obtener-restaurantes-sucursal":
	 		
	 		include ("../05. class/Hotel/class-sucursal.php");
	 		Sucursal::obtenerRestaurentesSucursal($conexion);
		break;

		case "obtener-restaurantes-sucursal2":
	 		
	 		include ("../05. class/Hotel/class-sucursal.php");
	 		Sucursal::obtenerRestaurentesSucursal2($conexion);
		break;

		case "obtener-hotel-sucursal":
	 		
	 		include ("../05. class/Hotel/class-sucursal.php");
	 		Sucursal::obtenerHotelSucursal($conexion);
		break;



	 	default:
	 		echo "Accion invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>