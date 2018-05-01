<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		/*case "registrar-sucursal":
			//echo "Entra en el case ";
	 		include ("../05. class/Hotel/class-sucursal.php");
	 		include ("../05. class/Hotel/class-hotel.php");
			
			$sucursal = new Sucursal(
	 			null, //idSucursal
	 			$_POST["txtreg-nombre"],
	 			$_POST["txtreg-cantidad-hab"],
	 			$_POST["txtreg-telefono"],
	 			$_POST["txtreg-email"],
	 			$_POST["txtreg-direccion"],
	 			$_POST["txtreg-descripcion"],
	 			$_POST["slcreg-restaurante"],
	 			null //idHotel
	 		
	 		); 

			$sucursal->registrarSucursal($conexion, $_POST["descripcionHotel"]);

	 	break;*/
	 	
	 	case "actualizar-sucursal":
	 		//echo "Entra en el case ";
	 		include ("../05. class/Hotel/class-sucursal.php");
			
		 	$sucursal = new Sucursal(
		 			$_POST["txt-idSucursal"], 
		 			$_POST["txt-nombre"],
		 			$_POST["txt-cantidad-hab"],
		 			$_POST["txt-telefono"],
		 			$_POST["txt-email"],
		 			$_POST["txt-direccion"],
		 			$_POST["txt-descripcion"],
		 			$_POST["slc-restaurante"],
		 			$_POST["slc-hotel"]);

		 	$sucursal->actualizarSucursal($conexion);

	 	break;
	 	
	 	case "eliminar-sucursal":
	 		//echo "Entra en el case Eliminar Cliente";
	 		include ("../05. class/Hotel/class-sucursal.php");
			Sucursal::eliminarSucursal($conexion, $_POST["idSucursal"]);
			//echo "Registro de Cliente Eliminado";
	 	break;

	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>