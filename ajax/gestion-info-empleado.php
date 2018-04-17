<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();
	
	switch ($_GET["accion"]) {
<<<<<<< HEAD
	
=======
		/*
		case "nombre-empleado":
			echo "Entra en el case";
	 		include ("../05. class/class-empleado.php");
			Class::nombreFuncion($conexion);
			echo "Mensaje";
	 	break;
	 	
	 	case "editar-empleado":
	 		echo "Entra en el case ";
	 		include ("../05. class/class-empleado.php");
			Class::nombreFuncion($conexion);
			echo "Mensaje";
	 	break;
		*/
>>>>>>> d1926eb86475f58bc6bc06287eb9b85a8f7f7eb7
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