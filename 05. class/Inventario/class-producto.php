<?php

	class Producto {

		private $idProducto;
		private $nombre;
		private $codigoBarra;
		private $precioCompra;
		private $precioVenta;
		private $fechaIngreso;
		private $fechaVencimiento;
		private $existencia;
		private $marca;
		private $descripcion;
		private $idCategoriaProducto;
		private $idBodega;

		public function __construct(
					$idProducto,
					$nombre,
					$codigoBarra,
					$precioCompra,
					$precioVenta,
					$fechaIngreso,
					$fechaVencimiento,
					$existencia,
					$marca,
					$descripcion,
					$idCategoriaProducto,
					$idBodega){
			$this->idProducto = $idProducto;
			$this->nombre = $nombre;
			$this->codigoBarra = $codigoBarra;
			$this->precioCompra = $precioCompra;
			$this->precioVenta = $precioVenta;
			$this->fechaIngreso = $fechaIngreso;
			$this->fechaVencimiento = $fechaVencimiento;
			$this->existencia = $existencia;
			$this->marca = $marca;
			$this->descripcion = $descripcion;
			$this->idCategoriaProducto = $idCategoriaProducto;
			$this->idBodega = $idBodega;
		}
		public function getIdProducto(){
			return $this->idProducto;
		}
		public function setIdProducto($idProducto){
			$this->idProducto = $idProducto;
		}
		public function getNombre(){
			return $this->nombre;
		}
		public function setNombre($nombre){
			$this->nombre = $nombre;
		}
		public function getCodigoBarra(){
			return $this->codigoBarra;
		}
		public function setCodigoBarra($codigoBarra){
			$this->codigoBarra = $codigoBarra;
		}
		public function getPrecioCompra(){
			return $this->precioCompra;
		}
		public function setPrecioCompra($precioCompra){
			$this->precioCompra = $precioCompra;
		}
		public function getPrecioVenta(){
			return $this->precioVenta;
		}
		public function setPrecioVenta($precioVenta){
			$this->precioVenta = $precioVenta;
		}
		public function getFechaIngreso(){
			return $this->fechaIngreso;
		}
		public function setFechaIngreso($fechaIngreso){
			$this->fechaIngreso = $fechaIngreso;
		}
		public function getFechaVencimiento(){
			return $this->fechaVencimiento;
		}
		public function setFechaVencimiento($fechaVencimiento){
			$this->fechaVencimiento = $fechaVencimiento;
		}
		public function getExistencia(){
			return $this->existencia;
		}
		public function setExistencia($existencia){
			$this->existencia = $existencia;
		}
		public function getMarca(){
			return $this->marca;
		}
		public function setMarca($marca){
			$this->marca = $marca;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function getIdCategoriaProducto(){
			return $this->idCategoriaProducto;
		}
		public function setIdCategoriaProducto($idCategoriaProducto){
			$this->idCategoriaProducto = $idCategoriaProducto;
		}
		public function getIdBodega(){
			return $this->idBodega;
		}
		public function setIdBodega($idBodega){
			$this->idBodega = $idBodega;
		}
		public function __toString(){
			return "IdProducto: " . $this->idProducto . 
				" Nombre: " . $this->nombre . 
				" CodigoBarra: " . $this->codigoBarra . 
				" PrecioCompra: " . $this->precioCompra . 
				" PrecioVenta: " . $this->precioVenta . 
				" FechaIngreso: " . $this->fechaIngreso . 
				" FechaVencimiento: " . $this->fechaVencimiento . 
				" Existencia: " . $this->existencia . 
				" Marca: " . $this->marca . 
				" Descripcion: " . $this->descripcion . 
				" IdCategoriaProducto: " . $this->idCategoriaProducto . 
				" IdBodega: " . $this->idBodega;
		}
	}
?>