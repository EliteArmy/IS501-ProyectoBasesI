<?php

	class TipoCuenta {

		private $idTipoCuenta;
		private $tipoCuenta;
		private $descripcion;

		public function __construct($idTipoCuenta,
					$tipoCuenta,
					$descripcion){
			$this->idTipoCuenta = $idTipoCuenta;
			$this->tipoCuenta = $tipoCuenta;
			$this->descripcion = $descripcion;
		}
		public function getIdTipoCuenta(){
			return $this->idTipoCuenta;
		}
		public function setIdTipoCuenta($idTipoCuenta){
			$this->idTipoCuenta = $idTipoCuenta;
		}
		public function getTipoCuenta(){
			return $this->tipoCuenta;
		}
		public function setTipoCuenta($tipoCuenta){
			$this->tipoCuenta = $tipoCuenta;
		}
		public function getDescripcion(){
			return $this->descripcion;
		}
		public function setDescripcion($descripcion){
			$this->descripcion = $descripcion;
		}
		public function __toString(){
			return "IdTipoCuenta: " . $this->idTipoCuenta . 
				" TipoCuenta: " . $this->tipoCuenta . 
				" Descripcion: " . $this->descripcion;
		}
	}
?>