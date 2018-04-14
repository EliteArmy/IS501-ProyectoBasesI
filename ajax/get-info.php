<?php

	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]){

		case "obtener-clientes":
			//echo "Entra en el case Cliente";
	 		include ("../05. class/class-cliente.php");
			Cliente::obternerListaClientes($conexion);

	 	break;
	 	
	 	case "obtener-empleados":
	 		//echo "Entra en el case Empleado";
	 		include ("../05. class/class-empleado.php");
			Empleado::obtenerListaEmpleados($conexion);

	 	break;
	 	/*
	 	case "obtener_empresas":
			include("../class/class-empresa.php"); 
			Empresa::obtenerListaEmpresas($conexion);		
	 		break;

	 	case "obtener_tipos_calificaciones":
	 		include("../class/class-tipo-calificacion.php"); 
	 		TipoCalificacion::obtenerListaTiposCalificaciones($conexion);
	 	break;

	 	case "obtener_tipos_contenidos":
	 		include("../class/class-tipo-contenido.php"); 
	 		TipoContenido::obtenerListaTiposContenidos($conexion);
	 	break;

	 	case "obtener-aplicaciones":
	 		include("../class/class-aplicacion.php"); 
	 		Aplicacion::obtenerListaAplicaciones($conexion);
	 	break;

	 	case "obtener-aplicacion":
	 		include("../class/class-aplicacion.php"); 
	 		Aplicacion::obtenerDetalleAplicaciones($conexion, $_POST["codigo-aplicacion"]);	 		
	 	break;
		*/
	 	default:
	 		echo "Accion invalida";
	 	break;
	 }

	 $conexion->cerrarConexion();
?>