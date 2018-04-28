<?php

	class DetalleFactura{

		private $idDetalleFactura;
		private $cantidad;
		private $descripcionReser;
		private $idFactura;
		private $idProducto;
		private $idPedido;
		private $idReservacion;

		public function __construct($idDetalleFactura,
					$cantidad,
					$descripcionReser,
					$idFactura,
					$idProducto,
					$idPedido,
					$idReservacion){
			$this->idDetalleFactura = $idDetalleFactura;
			$this->cantidad = $cantidad;
			$this->descripcionReser = $descripcionReser;
			$this->idFactura = $idFactura;
			$this->idProducto = $idProducto;
			$this->idPedido = $idPedido;
			$this->idReservacion = $idReservacion;
		}
		public function getIdDetalleFactura(){
			return $this->idDetalleFactura;
		}
		public function setIdDetalleFactura($idDetalleFactura){
			$this->idDetalleFactura = $idDetalleFactura;
		}
		public function getCantidad(){
			return $this->cantidad;
		}
		public function setCantidad($cantidad){
			$this->cantidad = $cantidad;
		}
		public function getDescripcionReser(){
			return $this->descripcionReser;
		}
		public function setDescripcionReser($descripcionReser){
			$this->descripcionReser = $descripcionReser;
		}
		public function getIdFactura(){
			return $this->idFactura;
		}
		public function setIdFactura($idFactura){
			$this->idFactura = $idFactura;
		}
		public function getIdProducto(){
			return $this->idProducto;
		}
		public function setIdProducto($idProducto){
			$this->idProducto = $idProducto;
		}
		public function getIdPedido(){
			return $this->idPedido;
		}
		public function setIdPedido($idPedido){
			$this->idPedido = $idPedido;
		}
		public function getIdReservacion(){
			return $this->idReservacion;
		}
		public function setIdReservacion($idReservacion){
			$this->idReservacion = $idReservacion;
		}
		public function __toString(){
			return "IdDetalleFactura: " . $this->idDetalleFactura . 
				" Cantidad: " . $this->cantidad . 
				" DescripcionReser: " . $this->descripcionReser . 
				" IdFactura: " . $this->idFactura . 
				" IdProducto: " . $this->idProducto . 
				" IdPedido: " . $this->idPedido . 
				" IdReservacion: " . $this->idReservacion;
		}
	}
?>