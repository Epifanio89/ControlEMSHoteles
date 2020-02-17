<?php

namespace App\Models;

use App\Config\Executor;

class ClienteModel extends Model {
	public $Nombres;
	public $Apellidos;
	public $Direccion;
	public $Telefono;
	public $Correo;
	public $IdCliente;


		function __construct(){
			self::$tablename = 'clientes';
			$this->Nombres = '';
			$this->Apellidos = '';
			$this->Direccion = '';
			$this->Telefono = '';
			$this->Correo = '';
			$this->IdCliente = '0';
		}

		public function add(){
			$query = "INSERT INTO ".self::$tablename." (IdCliente, Nombres, Apellidos, Direccion, Telefono, Correo) VALUES
			('0', '{$this->Nombres}', '{$this->Apellidos}', '{$this->Direccion}', '{$this->Telefono}', '{$this->Correo}')";
			$sql = Executor::doit($query);

			return $sql[1];
		}

		public function update(){
			$sql = "UPDATE ".self::$tablename." SET Nombres='{$this->Nombres}', Apellidos='{$this->Apellidos}', Direccion='{$this->Direccion}', Telefono='{$this->Telefono}', Correo='{$this->Correo}' WHERE IdCliente='{$this->IdCliente}';";
			Executor::doit($sql);
		}

}
