<?php

namespace App\Models;

use App\Config\Executor;

class ResumenModel extends Model {
	public $Fecha;
	public $Importe;
	public $Hotel;



		function __construct(){
			self::$tablename = 'reservacion';
			$this->Fecha = '';
			$this->Importe = '';
			$this->Hotel = '';

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

		public function getResumen($inical = '', $final = ''){
			$sql = "(select r.Fecha, FORMAT(sum(r.Importe), 2) as Importe,
							(Select h.Nombre from hotel as h where h.IdHotel = r.IdHotel limit 1 ) as Hotel
							from reservacion as r WHERE r.Fecha BETWEEN '{$inical}' and '{$final}' GROUP BY r.IdHotel )
							UNION
							( select '', FORMAT(ifnull(sum(r.Importe),0), 2) as Importe, 'Total' as Hotel
							from reservacion as r WHERE r.Fecha BETWEEN '{$inical}' and '{$final}' )";
			$query = Executor::doit($sql);

			return self::many($query[0]);
		}

}
