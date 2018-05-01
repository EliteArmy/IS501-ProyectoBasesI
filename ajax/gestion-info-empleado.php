<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();
	
	switch ($_GET["accion"]) {
		
	 	case "registrar-empleado":
	 		//echo "Entra en el case ";
	 		include ("../05. class/class-empleado.php");
	 		include("../05. class/class-telefono.php");

	 		$empleado = new Empleado(
	 			null, //idPersona
	 			$_POST["txtreg-primer-nombre"],
	 			$_POST["txtreg-segundo-nombre"],
	 			$_POST["txtreg-primer-apellido"],
	 			$_POST["txtreg-segundo-apellido"],
	 			$_POST["txtreg-email"],
	 			$_POST["txtreg-password"],
	 			$_POST["slcreg-genero"],
	 			$_POST["txtreg-direccion"],
	 			$_POST["txtreg-fecha-nacimiento"],
	 			null, //imagenIdentificacion

	 			null, //idEmpleado
	 			$_POST["txtreg-cod-empleado"],
	 			null, //fechaIngreso
	 			null, //fechaSalida
	 			$_POST["slcreg-estado"], 
	 			$_POST["slcreg-sucursal"], 
	 			$_POST["txtreg-id-empleado"], 

	 			new Telefono(null, $_POST["txtreg-telefono"], null));  //idTelefono, numeroTelefono, idPersona

	 		$empleado->registrarEmpleado($conexion);

	 	break;
	 	
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
				null,
				$_POST["slc-genero"],
				$_POST["txt-direccion"],
				$_POST["txt-fecha-nacimiento"],
				null, // imagenIdentificacion

				$_POST["idEmpleado"],
				null, // codigoEmpleado
				null, // fechaIngreso
				null, // fechaSalida
				$_POST["slc-estado"],
				$_POST["slc-sucursal"],
				$_POST["txt-id-empleado"],

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