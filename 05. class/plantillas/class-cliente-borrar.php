<?php
	
	class Cliente {

    private $idPersona;
    private $nombrePersona;
    private $apellidoPersona;
    private $email;
    private $fechaNacimiento;
    private $fechaRegistro;
    private $estado;
    private $direccion;		

		public function __construct(
					$idPersona,
					$nombrePersona,
					$apellidoPersona,
					$email,
					$fechaNacimiento,
					$fechaRegistro,
					$estado,
					$direccion){
			$this->idPersona = $idPersona;
			$this->nombrePersona = $nombrePersona;
			$this->apellidoPersona = $apellidoPersona;
			$this->email = $email;
			$this->fechaNacimiento = $fechaNacimiento;
			$this->fechaRegistro = $fechaRegistro;
			$this->estado = $estado;
			$this->direccion = $direccion;
		}

		public function getidPersona(){
			return $this->idPersona;
		}
		public function setidPersona($idPersona){
			$this->idPersona = $idPersona;
		}

		public function getnombrePersona(){
			return $this->nombrePersona;
		}
		public function setnombrePersona($nombrePersona){
			$this->nombrePersona = $nombrePersona;
		}

		public function getapellidoPersona(){
			return $this->apellidoPersona;
		}
		public function setapellidoPersona($apellidoPersona){
			$this->apellidoPersona = $apellidoPersona;
		}

		public function getemail(){
			return $this->email;
		}
		public function setemail($email){
			$this->email = $email;
		}
		public function getfechaNac(){
			return $this->fechaNacimiento;
		}
		public function setfechaNac($fechaNacimiento){
			$this->fechaNacimiento = $fechaNacimiento;
		}
		public function getfechaReg(){
			return $this->fechaRegistro;
		}
		public function setfechaReg($fechaRegistro){
			$this->fechaRegistro = $fechaRegistro;
		}
		public function getestado(){
			return $this->estado;
		}
		public function setestado($estado){
			$this->estado = $estado;
		}
		public function getdireccion(){
			return $this->direccion;
		}
		public function setdireccion($direccion){
			$this->direccion = $direccion;
		}

		public function __toString(){
			return "idPersona: " . $this->idPersona . 
				" nombrePersona: " . $this->nombrePersona . 
				" apellidoPersona: " . $this->apellidoPersona . 
				" email: " . $this->email . 
				" fecha Nacimiento: " . $this->fechaNacimiento . 
				" fecha Registro: " . $this->fechaRegistro . 
				" estado: " . $this->estado . 
				" direccion: " . $this->direccion;
		}

		public static function obternerListaClientes ($conexion) {

			$resultado = $conexion->ejecutarConsulta (
				'SELECT per.idPersona, per.primerNombre, per.primerApellido, per.email, per.fechaNacimiento, 
						cli.fechaRegistro, cli.estado, per.direccion
				FROM Persona per
				INNER JOIN Cliente cli ON (per.idPersona = cli.idPersona)'
			);

				while (($fila = $conexion->obtenerFila($resultado))) {

					echo '<tr>';
					echo 		'<td>' . $fila["idPersona"] . '</td>';
					echo 		'<td>' . $fila["primerNombre"] . '</td>';
					echo 		'<td>' . $fila["primerApellido"] . '</td>';
					echo 		'<td>' . $fila["email"] . '</td>';
					echo 		'<td>' . $fila["fechaNacimiento"] . '</td>';
					echo 		'<td>' . $fila["fechaRegistro"] . '</td>';
					echo 		'<td>' . $fila["estado"] . '</td>';
					echo 		'<td>' . $fila["direccion"] . '</td>';
					echo '</tr>';

				}
		}

	}
?>