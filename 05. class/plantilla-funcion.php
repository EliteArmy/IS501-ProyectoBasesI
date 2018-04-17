public static function nombreFuncion ($conexion) {
				
	$resultado = $conexion->ejecutarConsulta(
		''
	);
	
	while($fila = $conexion->obtenerFila($resultado)){
		echo '<tr>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo 		'<td>' . $fila[""] . '</td>';
		echo '</tr>';
	}

}