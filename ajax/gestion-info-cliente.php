<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

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
	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;

	 	case "editar-cliente":
				include_once("../05. class/class-cliente.php");
				$sql = sprintf(
					"SELECT p.primerNombre,
							p.primerApellido,
							p.email,
							p.fechaNacimiento,
							c.fechaRegistro,
							c.estado,
							p.direccion
					FROM persona p
					INNER JOIN cliente c ON c.idPersona = p.idPersona
				WHERE p.idPersona = '%s'",
				$conexion->getLink()->real_escape_string(stripslashes($_POST["idCliente"]))
			);
			$resultadoAplicacion = $conexion->ejecutarInstruccion($sql);
			$fila = $conexion->obtenerRegistro($resultadoAplicacion);
			
			echo json_encode($fila);
			break;
	 }

	 $conexion->cerrarConexion();
?>