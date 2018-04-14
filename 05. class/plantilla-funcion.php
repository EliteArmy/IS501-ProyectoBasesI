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