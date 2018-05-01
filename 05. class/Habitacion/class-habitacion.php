<?php

	class Habitacion {

		private $idHabitacion;
		private $numeroHabitacion;
		private $numeroPiso;
		private $estado;
		private $descripcion;
		private $idTipoCategoria;
		private $idTipoHabitacion;
		private $idSucursal;

		public function __construct($idHabitacion,
					$numeroHabitacion,
					$numeroPiso,
					$estado,
					$descripcion,
					$idTipoCategoria,
					$idTipoHabitacion,
					$idSucursal){
			$this->idHabitacion = $idHabitacion;
			$this->numeroHabitacion = $numeroHabitacion;
			$this->numeroPiso = $numeroPiso;
			$this->estado = $estado;
			$this->descripcion = $descripcion;
			$this->idTipoCategoria = $idTipoCategoria;
			$this->idTipoHabitacion = $idTipoHabitacion;
			$this->idSucursal = $idSucursal;
		}

		public function getIdHabitacion(){
			return $this->idHabitacion;
		}
		public function setIdHabitacion($idHabitacion){
			$this->idHabitacion = $idHabitacion;
		}

		public function getNumeroHabitacion(){
			return $this->numeroHabitacion;
		}
		public function setNumeroHabitacion($numeroHabitacion){
			$this->numeroHabitacion = $numeroHabitacion;
		}

		public function getNumeroPiso(){
			return $this->numeroPiso;
		}
		public function setNumeroPiso($numeroPiso){
			$this->numeroPiso = $numeroPiso;
		}

		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}

		public function getIdTipoCategoria(){
			return $this->idTipoCategoria;
		}
		public function setIdTipoCategoria($idTipoCategoria){
			$this->idTipoCategoria = $idTipoCategoria;
		}

		public function getIdTipoHabitacion(){
			return $this->idTipoHabitacion;
		}
		public function setIdTipoHabitacion($idTipoHabitacion){
			$this->idTipoHabitacion = $idTipoHabitacion;
		}

		public function getIdSucursal(){
			return $this->idSucursal;
		}
		public function setIdSucursal($idSucursal){
			$this->idSucursal = $idSucursal;
		}

		public function __toString(){
			return "IdHabitacion: " . $this->idHabitacion . 
				" NumeroHabitacion: " . $this->numeroHabitacion . 
				" NumeroPiso: " . $this->numeroPiso . 
				" Estado: " . $this->estado . 
				" Descripcion: " . $this->descripcion . 
				" IdTipoCategoria: " . $this->idTipoCategoria . 
				" IdTipoHabitacion: " . $this->idTipoHabitacion . 
				" IdSucursal: " . $this->idSucursal;
		}

		// --- Función que obtiene la lista de habitaciones ---
		public static function obtenerListaHabitaciones ($conexion) {
						
			$resultado = $conexion->ejecutarConsulta(
				'SELECT hab.idHabitacion, hab.numeroHabitacion, hab.numeroPiso, hab.estado, hab.descripcion, 
					tcat.tipoCategoria, thab.tipoHabitacion 
				FROM Habitacion hab 
				INNER JOIN TipoCategoria tcat ON (hab.idTipoCategoria = tcat.idTipoCategoria)
				INNER JOIN TipoHabitacion thab ON (hab.idTipoHabitacion = thab.idTipoHabitacion)
				ORDER BY hab.idHabitacion ASC'
			);

			//echo $resultado;
			
			while($fila = $conexion->obtenerFila($resultado)){
				echo '<tr>';
				echo 		'<td>' . $fila["idHabitacion"] . '</td>';
				echo 		'<td>' . $fila["numeroHabitacion"] . '</td>';
				echo 		'<td>' . $fila["numeroPiso"] . '</td>';
				echo 		'<td>' . $fila["estado"] . '</td>';
				echo 		'<td>' . $fila["descripcion"] . '</td>';
				echo 		'<td>' . $fila["tipoCategoria"] . '</td>';
				echo 		'<td>' . $fila["tipoHabitacion"] . '</td>';
				echo '<td><button type="button" onclick="obtenerDetalleHabitacion('.$fila["idHabitacion"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarHabitacion('.$fila["idHabitacion"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
			}

		}

		// --- Función para obtener la lista de habitaciones  ---
		public static function obtenerListaHabitaciones2 ($conexion){

			$resultado = $conexion->ejecutarConsulta(
				'SELECT hab.idHabitacion, hab.numeroHabitacion, hab.numeroPiso, hab.estado, hab.descripcion, 
					tcat.tipoCategoria, thab.tipoHabitacion 
				FROM Habitacion hab 
				INNER JOIN TipoCategoria tcat ON (hab.idTipoCategoria = tcat.idTipoCategoria)
				INNER JOIN TipoHabitacion thab ON (hab.idTipoHabitacion = thab.idTipoHabitacion)
				ORDER BY hab.idHabitacion ASC'
			);

			$data = array();

			while ($fila = $conexion->obtenerFila($resultado)){
				$data[] = $fila;
			}

			$i = 0;

			foreach ($data as $key) {
				$data[$i]['opciones'] = '<td><button type="button" onclick="obtenerDetalleHabitacion('.$fila["idHabitacion"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarHabitacion('.$fila["idHabitacion"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				$i++;
			}

			$datax = array('data' => $data);

			echo json_encode($datax);


		}

		// --- Función que prepopula la info. de la habitación en el modal ---
		public static function obtenerDetalleHabitacion ($conexion, $idHabitacion){

			$resultado = $conexion->ejecutarConsulta(
				"SELECT hab.idHabitacion, hab.numeroHabitacion, hab.numeroPiso, hab.estado, hab.descripcion, 
					hab.idTipoCategoria, hab.idTipoHabitacion, hab.idSucursal 
				FROM habitacion hab 
				WHERE hab.idHabitacion = '$idHabitacion' ");

			$fila = $conexion->obtenerFila($resultado);

			echo json_encode($fila);

		}


		public static function obtenerSucursalesHabitacion ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idSucursal, nombre 
				FROM sucursal'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idSucursal"].'">'.$fila["nombre"].'</option>';
			}
		}

		public static function obtenerTipoCategoriaHabitacion ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idTipoCategoria, tipoCategoria 
				FROM tipoCategoria'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idTipoCategoria"].'">'.$fila["tipoCategoria"].'</option>';
			}
		}

		public static function obtenerTipoHabHabitacion ($conexion){
			//echo "Entra en la funcion";

			$resultado = $conexion->ejecutarConsulta (
				'SELECT idTipoHabitacion, tipoHabitacion 
				FROM tipoHabitacion'
			);

			echo '<option>Seleccione una Opción</option>';
			while (($fila = $conexion->obtenerFila($resultado))) {
				echo '<option value="'.$fila["idTipoHabitacion"].'">'.$fila["tipoHabitacion"].'</option>';
			}
		}

		// --- Función que Guardara una nueva habitación ---
		public function registrarHabitacion ($conexion){

			$accion = "Agregar";
			$null = "null";

			$sql_callSP = "CALL SP_RegistrarHabitacion("
								.$null.","
								.$this->numeroHabitacion. ",".
								"'".$this->numeroPiso. "',".
								"'".$this->estado. "',".
								"'".$this->descripcion. "',".
								"'".$this->idTipoCategoria. "',".
								"'".$this->idTipoHabitacion. "',".
								"'".$this->idSucursal. "',".
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
		      	echo "<b>Registro Insertado con Exito</b><br>";
		        //echo $mensajeSP . " !@!false" . " <br>";
		      }

		}

		public function actualizarHabitacion ($conexion) {

			$accion = "Editar";

			$sql_callSP = "CALL SP_RegistrarHabitacion("
								.$this->idHabitacion.","
								.$this->numeroHabitacion. ",".
								"'".$this->numeroPiso. "',".
								"'".$this->estado. "',".
								"'".$this->descripcion. "',".
								"'".$this->idTipoCategoria. "',".
								"'".$this->idTipoHabitacion. "',".
								"'".$this->idSucursal. "',".
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

		// --- Función para Eliminar Habitaciones de la Base de Datos ---
		public static function eliminarHabitacion ($conexion, $idHabitacion) {
			
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE hab FROM habitacion hab
					WHERE hab.idHabitacion = '$idHabitacion'
				");

			echo "<b>Registro Elimimnado con Exito</b>";

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>