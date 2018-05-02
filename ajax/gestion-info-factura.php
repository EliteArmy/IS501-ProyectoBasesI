<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "registrar-factura":
			//echo "Entra en el case ";
	 		include ("../05. class/Contabilidad/class-factura.php");

	 		$factura = new Factura(
	 				null,
	 				$_POST["txtreg-numero-fac"],
	 				$_POST["txtreg-fecha-emision"],
		 			$_POST["txtreg-coste-reservacion"],
		 			$_POST["txtreg-coste-pedido"],
		 			$_POST["txtreg-coste-producto"],
		 			$_POST["txtreg-coste-total"],
		 			$_POST["txtreg-cambio"]),
		 			$_POST["txtreg-observacion"],
		 			$_POST["slcreg-cliente"],
		 			$_POST["slcreg-empleado"],
		 			$_POST["slcreg-tipofactura"],
		 			$_POST["slcreg-modoPago"]);

			$factura->registrarFactura($conexion);

	 	break;

default:

	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>