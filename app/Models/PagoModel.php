<?php

namespace App\Models;

use App\Config\Executor;

class PagoModel extends Model {
	public $Cliente;
	public $Concepto;
	public $Importe;
	public $ImporteActual;
	public $Fecha;
	public $Prestamo;
	public $IdPrestamo;
	public $IdPago;
	public $Folio;


		function __construct(){
			self::$tablename = 'pagos';
			$this->Concepto='';
			$this->IdCliente='';
			$this->Cliente='';
			$this->Total='';
			$this->Fecha='';
			$this->IdPago='0';
			$this->Prestamo='';
			$this->IdPrestamo='0';
			$this->Folio='';
		}

		public function add(){
			$query = "INSERT INTO ".self::$tablename." (IdPago, Folio, IdCliente, Concepto, Fecha, Total, IdPrestamo) VALUES
			('0', '{$this->Folio}', '{$this->IdCliente}', '{$this->Concepto}', '{$this->Fecha}', '{$this->Total}', '{$this->IdPrestamo}')";
			$sql = Executor::doit($query);

			return $sql[1];
		}

		public function update(){
			$sql = "UPDATE ".self::$tablename." SET Folio='{$this->Folio}', Concepto='{$this->Concepto}', Total='{$this->Total}', Fecha='{$this->Fecha}', IdCliente='{$this->IdCliente}', IdPrestamo='{$this->IdPrestamo}' WHERE IdPago='{$this->IdPago}'";
			Executor::doit($sql);
		}

		public static function getRanges($i, $q, $ord = 'id'){
        $sql = "SELECT p.*,(select concat(c.Nombres,' ',c.Apellidos) from clientes as c where c.IdCliente = p.IdCliente  ) as Cliente,
				(select c.Folio  from prestamos as c where c.IdPrestamo = p.IdPrestamo  ) as Prestamo
				FROM ".self::$tablename." as p  ORDER BY p.{$ord} LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);
				
        return self::many($query[0]);
    }

}
