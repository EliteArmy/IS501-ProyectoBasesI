<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();
	
	switch ($_GET["accion"]) {
		/*
		case "nombre-empleado":
			echo "Entra en el case";
	 		include ("../05. class/class-empleado.php");
			Class::nombreFuncion($conexion);
			echo "Mensaje";
	 	break;
	 	*/
	 	case "actualizar-empleado":

	 		include("../05. class/class-empleado.php");
	 		include("../05. class/class-telefono.php");

			$empleado = new Empleado(
				$_POST["txt-idempleado"],
				$_POST["txt-primer-nombre"],
				$_POST["txt-segundo-nombre"],
				$_POST["txt-primer-apellido"],
				$_POST["txt-segundo-apellido"],
				$_POST["txt-email"],
				null, // password
				null, // genero
				$_POST["txt-direccion"],
				$_POST["txt-fecha-nacimiento"],
				null, // imagenIdentificacion

				$_POST["idEmpleado"],
				null, // codigoEmpleado
				null, // fechaIngreso
				null, // fechaSalida
				$_POST["slc-estado"],
				null, // idSucursal
				null, // idEmpleadoSuperior

				new Telefono(null, $_POST["txt-telefono"], null) //idTelefono, numeroTelefono, idPersona
			);

			$empleado->actualizarEmpleado($conexion);

	 	break;
		
	 	case "eliminar-empleado":
	 		//echo "Entra en el case Eliminar Empleado";
	 		include ("../05. class/class-empleado.php");
			Empleado::eliminarEmpleado($conexion, $_POST["idEmpleado"]);
			//echo "Registro de Empleado Eliminado";
	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 	
	 }

	 $conexion->cerrarConexion();
?>