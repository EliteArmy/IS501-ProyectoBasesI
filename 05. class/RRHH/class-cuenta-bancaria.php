<?php

	class CuentaBancaria {

		private $idCuentaBancaria;
		private $numeroCuenta;
		private $idBanco;
		private $idTipoCuenta;
		private $idEmpleado;

		public function __construct(
					$idCuentaBancaria,
					$numeroCuenta,
					$idBanco,
					$idTipoCuenta,
					$idEmpleado){
			$this->idCuentaBancaria = $idCuentaBancaria;
			$this->numeroCuenta = $numeroCuenta;
			$this->idBanco = $idBanco;
			$this->idTipoCuenta = $idTipoCuenta;
			$this->idEmpleado = $idEmpleado;
		}
		public function getIdCuentaBancaria(){
			return $this->idCuentaBancaria;
		}
		public function setIdCuentaBancaria($idCuentaBancaria){
			$this->idCuentaBancaria = $idCuentaBancaria;
		}
		public function getNumeroCuenta(){
			return $this->numeroCuenta;
		}
		public function setNumeroCuenta($numeroCuenta){
			$this->numeroCuenta = $numeroCuenta;
		}
		public function getIdBanco(){
			return $this->idBanco;
		}
		public function setIdBanco($idBanco){
			$this->idBanco = $idBanco;
		}
		public function getIdTipoCuenta(){
			return $this->idTipoCuenta;
		}
		public function setIdTipoCuenta($idTipoCuenta){
			$this->idTipoCuenta = $idTipoCuenta;
		}
		public function getIdEmpleado(){
			return $this->idEmpleado;
		}
		public function setIdEmpleado($idEmpleado){
			$this->idEmpleado = $idEmpleado;
		}
		public function __toString(){
			return "IdCuentaBancaria: " . $this->idCuentaBancaria . 
				" NumeroCuenta: " . $this->numeroCuenta . 
				" IdBanco: " . $this->idBanco . 
				" IdTipoCuenta: " . $this->idTipoCuenta . 
				" IdEmpleado: " . $this->idEmpleado;
		}
	}
?>