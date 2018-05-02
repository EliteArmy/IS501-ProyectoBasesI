<?php
	
	class Sucursal {

		private $idSucursal;
		private $nombre;
		private $cantidadHabitaciones;
		private $telefono;
		private $email;
		private $direccion;
		private $descripcion;
		private $idRestaurante;
		private $idHotel;

		public function __construct($idSucursal,
					$nombre,
					$cantidadHabitaciones,
					$telefono,
					$email,
					$direccion,
					$descripcion,
					$idRestaurante,
					$idHotel){
			$this->idSucursal = $idSucursal;
			$this->nombre = $nombre;
			$this->cantidadHabitaciones = $cantidadHabitaciones;
			$this->telefono = $telefono;
			$this->email = $email;
			$this->direccion = $direccion;
			$this->descripcion = $descripcion;
			$this->idRestaurante = $idRestaurante;
			$this->idHotel = $idHotel;
		}

		public function getIdSucursal(){
			return $this->idSucursal;
		}
		public function setIdSucursal($idSucursal){
			$this->idSucursal = $idSucursal;
		}

		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getCantidadHabitaciones(){
			return $this->cantidadHabitaciones;
		}
		public function setCantidadHabitaciones($cantidadHabitaciones){
			$this->cantidadHabitaciones = $cantidadHabitaciones;
		}

		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function getEmail(){
			return $this->email;
		}
		public function setEmail($email){
			$this->email = $email;
		}

		public function getDireccion(){
			return $this->direccion;
		}
		public function setDireccion($direccion){
			$this->direccion = $direccion;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getIdRestaurante(){
			return $this->idRestaurante;
		}
		public function setIdRestaurante($idRestaurante){
			$this->idRestaurante = $idRestaurante;
		}

		public function getIdHotel(){
			return $this->idHotel;
		}
		public function setIdHotel($idHotel){
			$this->idHotel = $idHotel;
		}

		public function __toString(){
			return "IdSucursal: " . $this->idSucursal . 
				" Nombre: " . $this->nombre . 
				" CantidadHabitaciones: " . $this->cantidadHabitaciones . 
				" Telefono: " . $this->telefono . 
				" Email: " . $this->email . 
				" Direccion: " . $this->direccion . 
				" Descripcion: " . $this->descripcion . 
				" IdRestaurante: " . $this->idRestaurante . 
				" IdHotel: " . $this->idHotel;
		}

		// --- Función Futura ---
		public static function obtenerListaSucursales ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta(
				'SELECT s.idSucursal ,s.nombre,  COUNT(*) "Habitaciones disponibles", s.telefono, s.direccion, s.descripcion FROM habitacion h
				INNER JOIN sucursal s ON s.idSucursal = h.idSucursal
				WHERE h.estado = "disponible"
				GROUP BY s.idSucursal ASC'
			);
			
			while($fila = $conexion->obtenerFila($resultado)){
				echo '<tr>';
				echo 		'<td>' . $fila["idSucursal"] . '</td>';
				echo 		'<td>' . $fila["nombre"] . '</td>';
				echo 		'<td>' . $fila["Habitaciones disponibles"] . '</td>';
				echo 		'<td>' . $fila["telefono"] . '</td>';
				echo 		'<td>' . $fila["direccion"] . '</td>';
				echo 		'<td>' . $fila["descripcion"] . '</td>';
				echo '<td><button type="button" onclick="obtenerDetalleSucursal('.$fila["idSucursal"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarSucursal('.$fila["idSucursal"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
			}

		}

		public static function obtenerListaSucursales2 ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta(
				'SELECT s.idSucursal ,s.nombre,  COUNT(*) "Habitaciones disponibles", s.telefono, s.direccion, s.descripcion FROM habitacion h
				INNER JOIN sucursal s ON s.idSucursal = h.idSucursal
				WHERE h.estado = "disponible"
				GROUP BY s.idSucursal ASC'
			);

			$data = array();

			while ($fila = $conexion->obtenerFila($resultado)){
				$data[] = $fila;
			}

			$i = 0;

			foreach ($data as $key) {
				$data[$i]['opciones'] = '<td><button type="button" onclick="obtenerDetalleSucursal('.$fila["idSucursal"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarSucursal('.$fila["idSucursal"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';

				$i++;
			}

			$datax = array('data' => $data);

			echo json_encode($datax);

		}

		// --- Función que Prepopula la informacion en el Modal ---
		public static function obtenerDetalleSucursal ($conexion, $idSucursal){

			$resultado = $conexion->ejecutarConsulta(
				"SELECT suc.nombre, suc.cantidadHabitaciones, suc.telefono,
				suc.email, suc.direccion, suc.descripcion, suc.idRestaurante, suc.idHotel, h.descripcionHotel FROM Sucursal suc
				INNER JOIN hotel h ON (h.idHotel = suc.idHotel)
				WHERE suc.idSucursal = '$idSucursal'");

			$fila = $conexion->obtenerFila($resultado);

			echo json_encode($fila);
		}

		public static function obtenerRestaurentesSucursal ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idRestaurante 
				FROM restaurante'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idRestaurante"].'">'.$fila["idRestaurante"].'</option>';
			}
		}

		public static function obtenerRestaurentesSucursal2 ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idRestaurante 
				FROM restaurante'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idRestaurante"].'">'.$fila["idRestaurante"].'</option>';
			}
		}

		public static function obtenerHotelSucursal ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idHotel, descripcionHotel 
				FROM hotel'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idHotel"].'">'.$fila["descripcionHotel"].'</option>';
			}
		}

		/*Función para registrar sucursal*/
		public function registrarSucursal($conexion, $descripcionHotel){

			$accion = "Agregar";
			$null = "null";

			$sql_callSP = "CALL SP_RegistrarSucursales("
					.$null. ",". 
				  "'".$this->nombre. "'," 
				  .$this->cantidadHabitaciones. ",".
				  "'".$this->telefono. "',".
				  "'".$this->email. "',".
				  "'".$this->direccion. "',".
				  "'".$this->descripcion. "',".
				  "'".$this->idRestaurante. "',"
					.$null. ",".
				  "'".$descripcionHotel. "',".
				  "'".$accion."',". 
				  "@pcMensaje, 
				  @pbOcurrioError)";

			 echo "<br>Lammado: " .$sql_callSP ."<br>"; 

			$resultado = $conexion->ejecutarConsulta($sql_callSP); // mysqli_query ($this->link, $sql);

			$return = $conexion->getParametroSP("@pcMensaje, @pbOcurrioError");

      if ($resultado != '1') { // 
        echo "Error: " . $resultado . " <br>";

      }

      $mensajeSP = $return['@pcMensaje'];
      $ocurreError = $return['@pbOcurrioError'];
      
      if ($ocurreError == "1"){
          echo '<b>'. $mensajeSP . '</b>'." !@!true" . " <br>";
      } else {
      	echo "<b>Registro Insertado con Exito</b><br>";
        //echo $mensajeSP . " !@!false" . " <br>";
      }

			/*$resultado = $conexion->ejecutarConsulta(
					"INSERT INTO hotel 
							VALUES(null,
								   '$this->descripcionHotel')");

			if(!($idTemporal = $conexion->ultimoId())){  // Obtener el ultimo Id de la persona que se inserto
				echo "<b>No se pudo Insertar el registro.</b>";
				return "";
			}

			$resultado = $conexion->ejecutarConsulta(
						"INSERT INTO sucursal
								VALUES (null,
										'$this->nombre',
										'$this->cantidadHabitaciones',
										'$this->telefono',
										'$this->email',
										'$this->direccion',
										'$this->descripcion',
										'$this->idRestaurante',
										'$idTemporal')");


			echo "<b>Registro Insertado con Exito</b>";*/
		}

		/*Función para actualizar la información */
		public function actualizarSucursal($conexion, $descripcionHotel){

			/*$resultado = $conexion->ejecutarConsulta(
						"UPDATE sucursal suc
							SET suc.idSucursal = '$this->idSucursal',
								suc.nombre = '$this->nombre',
								suc.cantidadHabitaciones = '$this->cantidadHabitaciones',
								suc.telefono = '$this->telefono',
								suc.email = '$this->email',
								suc.direccion = '$this->direccion',
								suc.descripcion = '$this->descripcion',
								suc.idRestaurante = '$this->idRestaurante',
								suc.idHotel = '$this->idHotel'
							WHERE suc.idSucursal = '$this->idSucursal'");

		echo "<b>Registro actualizado con Exito</b>";*/

		$accion = "editar";

			$sql_callSP = "CALL SP_RegistrarSucursales("
								.$this->idSucursal.","
								.$this->nombre. ",".
								"'".$this->cantidadHabitaciones. "',".
								"'".$this->telefono. "',".
								"'".$this->email. "',".
								"'".$this->direccion. "',".
								"'".$this->descripcion. "',".
								"'".$this->idRestaurante. "',". 
								"'".$this->idHotel. "',".
					 			 "'".$descripcionHotel. "',".
								"'".$accion."',". 
								"@pcMensaje, 
								@pbOcurrioError)";

			$resultado = $conexion->ejecutarConsulta($sql_callSP); // mysqli_query ($this->link, $sql);

			$return = $conexion->getParametroSP("@pcMensaje, @pbOcurrioError");

		      if ($resultado != '1') {
		        echo "Error: " . $resultado . " <br>";

		      }

		      $mensajeSP = $return['@pcMensaje'];
		      $ocurreError = $return['@pbOcurrioError'];
		      
		      if ($ocurreError == "1"){
		          echo $mensajeSP . " !@!true" . " <br>";
		      } else {
		      	echo "<b>Registro Actualizado con Exito</b><br>";
		        //echo $mensajeSP . " !@!false" . " <br>";
		      }

		}


		// --- Función para Eliminar Sucursales de la Base de Datos ---
		public static function eliminarSucursal ($conexion, $idSucursal){

			//echo "Entra en la función";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE suc FROM sucursal suc
					WHERE suc.idSucursal = '$idSucursal'
				");

			echo "<b>Registro Eliminado con Exito</b>";
		}




		// --- Función Futura ---
		public static function nombreFuncion6 ($conexion){

		}

	}
?>