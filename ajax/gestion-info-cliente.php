<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();
<<<<<<< HEAD
	
	switch ($_GET["accion"]) {
	 	case "eliminar-cliente":
	 		//echo "Entra en el case eliminar cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::eliminarCliente($conexion, $_POST["idPersona"]);
			echo "Registro de Cliente Eliminado";

=======

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
	 	case "eliminar-cliente":
	 		//echo "Entra en el case Eliminar Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::eliminarCliente($conexion, $_POST["idPersona"]);
			//echo "Registro de Cliente Eliminado";
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>