<?php

	include_once("abstract-class-persona.php");

	class Cliente extends Persona {

		protected $idCliente;
		protected $fechaRegistro;
		protected $estado;
		protected $idPersona;

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
				$estado) {
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
			$this->idPersona = $idPersona;
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

		public function getIdPersona(){
			return $this->idPersona;
		}
		public function setIdPersona($idPersona){
			$this->idPersona = $idPersona;
		}

		public function __toString(){
			return parent::__toString() . "IdCliente: " . $this->idCliente . 
				" FechaRegistro: " . $this->fechaRegistro . 
				" Estado: " . $this->estado . 
				" IdPersona: " . $this->idPersona;
		}

		// --- Función para obtener la Lista de Clientes ---
		public static function obternerListaClientes ($conexion) {
			/*
			// Ahora se maneja esta consulta con el procedimiento almacenado: CALL SP_ObtenerClientes
			$resultado = $conexion->ejecutarConsulta (
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)'
			);
			*/
			$resultado = $conexion->ejecutarConsulta("CALL SP_ObtenerClientes");

			while ($fila = $conexion->obtenerFila($resultado)) {

				echo '<tr>';
				echo 		'<td>' . $fila["idPersona"] . '</td>';
				echo 		'<td>' . $fila["primerNombre"] . '</td>';
				echo 		'<td>' . $fila["primerApellido"] . '</td>';
				echo 		'<td>' . $fila["email"] . '</td>';
				echo 		'<td>' . $fila["fechaNacimiento"] . '</td>';
				echo 		'<td>' . $fila["fechaRegistro"] . '</td>';
				echo 		'<td>' . $fila["estado"] . '</td>';
				echo 		'<td>' . $fila["direccion"] . '</td>';
				echo '<td><button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalForm">
   					<span class="fas fa-edit"></span>
					</button>

					<!-- Modal -->
					<div class="modal fade" id="modalForm" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<!-- Modal Header -->
								<div class="modal-header">
									<h5 class="modal-title" id="myModalLabel">
									Información sobre el Cliente</h5>
								</div>
							<!-- Modal Body -->
							<div class="modal-body">
								<p class="statusMsg"></p>
								<form role="form">
									<div class="form-group">
										<label for="inputName">Nombre</label>
										<input type="text" class="form-control" id="inputName" placeholder="Ingrese el nombre"</input>
									</div>
									<div class="form-group">
									    <label for="inputEmail">Apellido</label>
									   	<input type="email" class="form-control" id="inputEmail" placeholder="Ingrese el apellido"</input>
									</div>
									<div class="form-group">
									    <label for="inputMessage">Email</label>
									    <input class="form-control" id="inputMessage" placeholder="Ingrese el correo electrónico"></input>
									</div>
									<div class="form-group">
										<label for="inputName">Fecha Nacimiento</label>
										<input type="date" class="form-control" id="inputName"</input>
									</div>
									<div class="form-group">
										<label for="inputName">Fecha Registro</label>
										<input type="date" class="form-control" id="inputName"</input>
									</div>
									<div class="form-group">
									Estado
									    <select name="slc-pais" id="slc-pais" class="form-control">
											<option>---Seleccione un estado---</option>
											<option value="1">Activo</option>
											<option value="2">Inactivo</option>
										</select>
									</div>
									<div class="form-group">
				                        <label for="inputMessage">Dirección</label>
				                        <textarea class="form-control" id="inputMessage" placeholder="Ingrese la dirección"></textarea>
				                    </div>
								</form>
							</div>
							<!-- Modal Footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								<button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">Guardar</button>
							</div>
						 </div>
					</div>
				</div>  
				<button type="button" onclick="eliminarCliente('.$fila["idPersona"].')" class="btn btn-default btn-sm"><span class="fas fa-trash-alt"></span></button></td>';
				echo '</tr>';

			}
		}

		// --- Función para Eliminar Clientes de la Base de Datos ---
		public static function eliminarCliente ($conexion, $idCliente){

			//echo "Entra en la función";
			$resultado = $conexion->ejecutarConsulta(
				"DELETE per 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE per.idPersona = '$idCliente'
				");
		}

		// --- Función Futura ---
		public static function editarCliente ($conexion){

			$resultado = $conexion->ejecutarConsulta(
				"UPDATE per 
					FROM persona per
					INNER JOIN cliente cli ON (per.idPersona = cli.idPersona) 
					WHERE per.idPersona = '$idCliente'
				");
		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>