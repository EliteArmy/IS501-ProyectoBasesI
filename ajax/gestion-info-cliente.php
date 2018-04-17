<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();
	
	switch ($_GET["accion"]) {
	 	case "eliminar-cliente":
	 		//echo "Entra en el case eliminar cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::eliminarCliente($conexion, $_POST["idPersona"]);
			echo "Registro de Cliente Eliminado";

	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>