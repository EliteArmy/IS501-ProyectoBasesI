<?php
	
	session_start(); 
	
	include("../05. class/class-conexion.php");
	$conexion = new Conexion();

	switch ($_GET["accion"]) {
		
		//alert($_POST["email"]);
		//alert($_POST["password"]);

		case 'login':
	 		include ("../05. class/class-usuario.php");
			Usuario::verificarUsuario($conexion, $_POST["email"], $_POST["password"]);

		break;
	
		default:
			echo "Accion Invalida";
		break;
	}

	$conexion->cerrarConexion();
?>