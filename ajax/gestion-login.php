<?php
	
	session_start(); 
	
	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]) {
		
		case 'login':
	 		include ("../05. class/class-cliente.php");
			Usuario::verificarUsuario($conexion, $_POST["email"], $_POST["password"]);
		break;
	
		default:
			echo "Accion Invalida";
		break;
	}

	$conexion->cerrarConexion();
?>