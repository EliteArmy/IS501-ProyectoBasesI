<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();
	
	switch ($_GET["accion"]) {
	
	 	case "eliminar-empleado":
	 		//echo "Entra en el case Eliminar Empleado";
	 		include ("../05. class/class-empleado.php");
			Empleado::eliminarEmpleado($conexion, $_POST["idPersona"]);
			echo "Registro de Empleado Eliminado";

	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>