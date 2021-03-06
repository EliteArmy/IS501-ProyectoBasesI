<?php

	include_once("abstract-class-persona.php");

	class Cliente extends Persona {

		protected $idCliente;
		protected $fechaRegistro;
		protected $estado;

		protected $telefono;

		public function __construct(
				$idPersona,
				$primerNombre,
				$segundoNombre,
				$primerApellido,
				$segundoApellido,
				$email,
				$password,
				$genero,
				$direccion,
				$fechaNacimiento,
				$imagenIdentificacion,

				$idCliente,
				$fechaRegistro,
				$estado,

				$telefono) {
			parent::__construct(
					$idPersona,
					$primerNombre,
					$segundoNombre,
					$primerApellido,
					$segundoApellido,
					$email,
					$password,
					$genero,
					$direccion,
					$fechaNacimiento,
					$imagenIdentificacion);
			
			$this->idCliente = $idCliente;
			$this->fechaRegistro = $fechaRegistro;
			$this->estado = $estado;

			$this->telefono = $telefono;
		}


		public function getIdCliente(){
			return $this->idCliente;
		}
		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}

		public function getFechaRegistro(){
			return $this->fechaRegistro;
		}
		public function setFechaRegistro($fechaRegistro){
			$this->fechaRegistro = $fechaRegistro;
		}

		public function getEstado(){
			return $this->estado;
		}
		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getTelefono(){
			return $this->telefono;
		}
		public function setTelefono($telefono){
			$this->telefono = $telefono;
		}

		public function __toString(){
			return parent::__toString() . "IdCliente: " . $this->idCliente . 
				" FechaRegistro: " . $this->fechaRegistro . 
				" Estado: " . $this->estado . 
				" Telefono: " . $this->telefono;
		}

		// --- Función para obtener la Lista de Clientes ---
		public static function obtenerListaClientes ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta (
				'SELECT cli.idCliente, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS Edad
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)
				WHERE TIMESTAMPDIFF(MONTH, fechaNacimiento, CURDATE()) >= "216"'
			);
			
			// Esto maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerClientes
			//$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerClientes");

			while ($fila = $conexion->obtenerFila($resultado)) {

				echo '<tr>';
				echo 		'<td id="">' . $fila["idCliente"] . '</td>';
				echo 		'<td id="">' . $fila["primerNombre"] . '</td>';
				echo 		'<td id="">' . $fila["primerApellido"] . '</td>';
				echo 		'<td id="">' . $fila["email"] . '</td>';
				echo 		'<td id="">' . $fila["fechaNacimiento"] . '</td>';
				echo 		'<td id="">' . $fila["fechaRegistro"] . '</td>';
				echo 		'<td id="">' . $fila["estado"] . '</td>';
				echo 		'<td id="">' . $fila["direccion"] . '</td>';
				echo '<td><button type="button" onclick="obtenerDetalleCliente('.$fila["idCliente"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button>
							<button type="button" onclick="eliminarCliente('.$fila["idCliente"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';
			}
		} 

		// --- Función para obtener la Lista de Clientes ---
		public static function obtenerListaClientes2 ($conexion) {
			
			$resultado = $conexion->ejecutarConsulta (
				'SELECT cli.idCliente, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion, TIMESTAMPDIFF(YEAR, fechaNacimiento, CURDATE()) AS Edad
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)
				WHERE TIMESTAMPDIFF(MONTH, fechaNacimiento, CURDATE()) >= "216"'
			);
			
			$data = array();

			while ($fila = $conexion->obtenerFila($resultado)){
				$data[] = $fila;
			}

			$i = 0;

			foreach ($data as $key) {
				$data[$i]['opciones'] = '<td><button type="button" onclick="obtenerDetalleCliente('.$data[$i]["idCliente"].')" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm"><span class="fas fa-edit"></span></button> 
						<button type="button" onclick="eliminarCliente('.$data[$i]["idCliente"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				$i++;
			}

			$datax = array('data' => $data);

			echo json_encode($datax);
		}

		// --- Función que Prepopula la informacion en el Modal ---
		public static function obtenerDetalleCliente ($conexion, $idCliente){
			//echo "Entra en la funcion";
			$resultado = $conexion->ejecutarConsulta(
				"SELECT cli.idCliente, per.primerNombre, per.segundoNombre, per.primerApellido, per.segundoApellido, 
				per.email, tel.numeroTelefono, per.fechaNacimiento, cli.estado, per.direccion 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
					WHERE cli.idCliente = '$idCliente'
				");

			$fila = $conexion->obtenerFila($resultado);

			echo json_encode($fila);
		}

		// --- Función que Guardará la nueva información ---
		public function actualizarCliente($conexion){
			
			$telefono = $this->telefono->getNumeroTelefono();
			//echo $telefono;

			$resultado = $conexion->ejecutarConsulta(
				"UPDATE persona per
				INNER JOIN cliente cli ON (per.idPersona = cli.idPersona)
				INNER JOIN telefono tel ON (per.idPersona = tel.idPersona)
				SET per.primerNombre = '$this->primerNombre',
					per.segundoNombre = '$this->segundoNombre',
					per.primerApellido = '$this->primerApellido',
					per.segundoApellido = '$this->segundoApellido',
					per.email = '$this->email',
					per.direccion = '$this->direccion',
					per.fechaNacimiento = '$this->fechaNacimiento',
					tel.numeroTelefono = '$telefono',
					cli.estado = '$this->estado'
				WHERE cli.idCliente = '$this->idCliente'
				");

			echo "<b>Registro actualizado con Exito</b>";
			
		}

		// --- Función para Eliminar Clientes de la Base de Datos ---
		public static function eliminarCliente ($conexion, $idCliente){

			//echo "Entra en la función";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE cli.idCliente = '$idCliente'
				");

			echo "<b>Registro Elimimnado con Exito</b>";
		}

		// --- Función que Guardara un nuevo Registro ---
		public function registrarCliente($conexion){

			$passwordHash = md5($this->password);
			$telefono = $this->telefono->getNumeroTelefono();
			$accion = "Agregar";
			$null = "null";
			
			$sql_callSP = "CALL SP_RegistrarCliente("
								.$null. ",".  
							  "'".$this->primerNombre. "',".
							  "'".$this->segundoNombre. "',".
							  "'".$this->primerApellido. "',".
							  "'".$this->segundoApellido. "',".
							  "'".$this->email. "',".
							  "'".$passwordHash. "',".
							  "'".$this->genero. "',". 
							  "'".$this->direccion. "',".
							  "'".$this->fechaNacimiento. "'," 
							  .$null. "," 
							  .$telefono. "," 
							  .$null. ",".
							  "'".$this->estado. "',"
							  .$null. ",". 
							  "'".$accion."',". 
							  "@pcMensaje, 
							  @pbOcurrioError)";

			//echo "<br>Lammado: " .$sql_callSP ."<br>";

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

		// --- Función que Guardara un nuevo Registro ---
		public  function registrarClienteViejo($conexion){

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO persona 
				(idPersona, primerNombre, segundoNombre, primerApellido, segundoApellido, 
				email, password, genero, direccion, fechaNacimiento, imagenIdentificacion) 
				VALUES (null, '$this->primerNombre', '$this->segundoNombre', '$this->primerApellido', '$this->segundoApellido', 
				'$this->email', '$this->password', '$this->genero', '$this->direccion', '$this->fechaNacimiento', null)"
			);

			$idTemporal = $conexion->ultimoId(); // Obtener el ultimo Id de la persona que se inserto

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO cliente
				(idCliente, fechaRegistro, estado, idPersona) 
				VALUES (null,  CURDATE(), '$this->estado', '$idTemporal')
			");

			$telefono = $this->telefono->getNumeroTelefono();

			$resultado = $conexion->ejecutarConsulta (
				"INSERT INTO telefono
				(idTelefono, numeroTelefono, idPersona) 
				VALUES (null, '$telefono', '$idTemporal')
			");

			echo "<b>Registro Insertado con Exito</b>";
		}

		// --- Función Futura ---
		public static function nombreFuncion2($conexion){

		}

	}
?>