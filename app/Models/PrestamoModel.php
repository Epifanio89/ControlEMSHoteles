<?php

namespace App\Models;

use App\Config\Executor;

class PrestamoModel extends Model {
	public $Cliente;
	public $Concepto;
	public $Importe;
	public $ImporteActual;
	public $Fecha;
	public $IdPrestamo;
	public $Folio;


		function __construct(){
			self::$tablename = 'prestamos';
			$this->Concepto='';
			$this->IdCliente='';
			$this->Cliente='';
			$this->Importe='';
			$this->ImporteActual='';
			$this->Fecha='';
			$this->IdPrestamo='0';
			$this->Folio='';
		}

		public function add(){
			$query = "INSERT INTO ".self::$tablename." (IdPrestamo, Folio, Concepto, Importe, Fecha, IdCliente) VALUES
			('0', '{$this->Folio}', '{$this->Concepto}', '{$this->Importe}', '{$this->Fecha}', '{$this->IdCliente}')";
			$sql = Executor::doit($query);

			return $sql[1];
		}

		public function update(){
			$sql = "UPDATE ".self::$tablename." SET Folio='{$this->Folio}', Concepto='{$this->Concepto}', Importe='{$this->Importe}', Fecha='{$this->Fecha}', IdCliente='{$this->IdCliente}' WHERE IdPrestamo='{$this->IdPrestamo}'";
			Executor::doit($sql);
		}

		public static function getRanges($i, $q, $ord = 'id'){
        $sql = "SELECT p.*,(select concat(c.Nombres,' ',c.Apellidos) from clientes as c where c.IdCliente = p.IdCliente  ) as Cliente,
				IFNULL((p.Importe - (select sum(c.Total) from pagos as c where c.IdPrestamo = p.IdPrestamo  )), p.Importe) as ImporteActual
				FROM ".self::$tablename." as p  ORDER BY p.{$ord} LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

}
