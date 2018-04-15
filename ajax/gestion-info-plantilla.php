<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "":
			//echo "Entra en el case ";
	 		include ("../05. class/class-.php");
			Class::nombreFuncion($conexion);

	 	break;
	 	
	 	case "":
	 		//echo "Entra en el case ";
	 		include ("../05. class/class-.php");
			Class::nombreFuncion($conexion);

	 	break;
	 	
	 	default:
	 		echo "Accion Invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>