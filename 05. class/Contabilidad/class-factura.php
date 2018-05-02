<?php

	class Factura {

		private $idFactura;
		private $numFactura;
		private $fechaEmision;
		private $costeReservacion;
		private $costePedido;
		private $costeProducto;
		private $costeTotal;
		private $cambio;
		private $observacion;
		private $idCliente;
		private $idEmpleado;
		private $idTipoFactura;
		private $idModoPago;

		public function __construct(
					$idFactura,
					$numFactura,
					$fechaEmision,
					$costeReservacion,
					$costePedido,
					$costeProducto,
					$costeTotal,
					$cambio,
					$observacion,
					$idCliente,
					$idEmpleado,
					$idTipoFactura,
					$idModoPago){
			$this->idFactura = $idFactura;
			$this->numFactura = $numFactura;
			$this->fechaEmision = $fechaEmision;
			$this->costeReservacion = $costeReservacion;
			$this->costePedido = $costePedido;
			$this->costeProducto = $costeProducto;
			$this->costeTotal = $costeTotal;
			$this->cambio = $cambio;
			$this->observacion = $observacion;
			$this->idCliente = $idCliente;
			$this->idEmpleado = $idEmpleado;
			$this->idTipoFactura = $idTipoFactura;
			$this->idModoPago = $idModoPago;
		}

		public function getIdFactura(){
			return $this->idFactura;
		}
		public function setIdFactura($idFactura){
			$this->idFactura = $idFactura;
		}

		public function getNumFactura(){
			return $this->numFactura;
		}
		public function setNumFactura($numFactura){
			$this->numFactura = $numFactura;
		}

		public function getFechaEmision(){
			return $this->fechaEmision;
		}
		public function setFechaEmision($fechaEmision){
			$this->fechaEmision = $fechaEmision;
		}

		public function getCosteReservacion(){
			return $this->costeReservacion;
		}
		public function setCosteReservacion($costeReservacion){
			$this->costeReservacion = $costeReservacion;
		}

		public function getCostePedido(){
			return $this->costePedido;
		}
		public function setCostePedido($costePedido){
			$this->costePedido = $costePedido;
		}

		public function getCosteProducto(){
			return $this->costeProducto;
		}
		public function setCosteProducto($costeProducto){
			$this->costeProducto = $costeProducto;
		}

		public function getCosteTotal(){
			return $this->costeTotal;
		}
		public function setCosteTotal($costeTotal){
			$this->costeTotal = $costeTotal;
		}

		public function getCambio(){
			return $this->cambio;
		}
		public function setCambio($cambio){
			$this->cambio = $cambio;
		}

		public function getObservacion(){
			return $this->observacion;
		}
		public function setObservacion($observacion){
			$this->observacion = $observacion;
		}

		public function getIdCliente(){
			return $this->idCliente;
		}
		public function setIdCliente($idCliente){
			$this->idCliente = $idCliente;
		}

		public function getIdEmpleado(){
			return $this->idEmpleado;
		}
		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}

		public function getIdTipoFactura(){
			return $this->idTipoFactura;
		}
		public function setIdTipoFactura($idTipoFactura){
			$this->idTipoFactura = $idTipoFactura;
		}

		public function getIdModoPago(){
			return $this->idModoPago;
		}
		public function setIdModoPago($idModoPago){
			$this->idModoPago = $idModoPago;
		}

		public function __toString(){
			return "IdFactura: " . $this->idFactura . 
				" NumFactura: " . $this->numFactura . 
				" FechaEmision: " . $this->fechaEmision . 
				" CosteReservacion: " . $this->costeReservacion . 
				" CostePedido: " . $this->costePedido . 
				" CosteProducto: " . $this->costeProducto . 
				" CosteTotal: " . $this->costeTotal . 
				" Cambio: " . $this->cambio . 
				" Observacion: " . $this->observacion . 
				" IdCliente: " . $this->idCliente . 
				" IdEmpleado: " . $this->idEmpleado . 
				" IdTipoFactura: " . $this->idTipoFactura . 
				" IdModoPago: " . $this->idModoPago;
		}

		// --- Función Futura ---
		public static function obtenerListaFacturas ($conexion) {
						
			$resultado = $conexion->ejecutarConsulta(
				'SELECT fac.idFactura, fac.numFactura, fac.fechaEmision, fac.costeReservacion, fac.costeProducto, 
				fac.costePedido, fac.costeTotal, fac.cambio, fac.observacion 
				FROM Factura fac'
			);
			
			while($fila = $conexion->obtenerFila($resultado)){
				echo '<tr>';
				echo 		'<td>' . $fila["idFactura"] . '</td>';
				echo 		'<td>' . $fila["numFactura"] . '</td>';
				echo 		'<td>' . $fila["fechaEmision"] . '</td>';
				echo 		'<td>' . $fila["costeReservacion"] . '</td>';
				echo 		'<td>' . $fila["costePedido"] . '</td>';
				echo 		'<td>' . $fila["costeProducto"] . '</td>';
				echo 		'<td>' . $fila["costeTotal"] . '</td>';
				echo 		'<td>' . $fila["cambio"] . '</td>';
				echo 		'<td>' . $fila["observacion"] . '</td>';
				echo '</tr>';
			}

		}

		// --- Función Futura  ---
		public static function registrarFactura ($conexion){
			$accion = "Agregar";
			$null = "null";
			//echo "Id: ". $this->idCliente;
			
			$sql_callSP = "CALL SP_RegistrarFacturas("
						.$null. "," 
					  .$null. ","
					  .$null. "," . 
					  .$this->costeReservacion. ","
					  .$null. ","
					  .$null. ",".
					  .$this->costeReservacion. ","
					  .$this->cambio. ","
					  "'".$this->observacion. "',"
					  .$this->idCliente. ","
					  .$this->idEmpleado. ","
					  .$this->idTipoFactura. ",".
					  .$this->idModoPago.",". 
					  "@pcMensaje, 
					  @pbOcurrioError)";

			//echo "<br>Lammado: " .$sql_callSP ."<br>"; 

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
      //echo "Final Funcion";

		}

		// --- Función Futura ---
		public static function nombreFuncion3 ($conexion){

		}

	}
?>