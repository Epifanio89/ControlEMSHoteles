<?php

namespace App\Models;

use App\Config\Executor;

class HotelesModel extends Model {
	public $Codigo;
	public $Nombre;
	public $RazonSocial;
	public $RFC;
	public $Direccion;
	public $IdHotel;

	function __construct(){
		self::$tablename = 'hotel';
		$this->Codigo = '';
		$this->Nombre = '';
		$this->RazonSocial='';
		$this->RFC = '';
		$this->Direccion = '';
		$this->IdHotel = '0';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdHotel, Codigo, Nombre, RazonSocial, RFC, Direccion) VALUES ('0', '{$this->Codigo}', '{$this->Nombre}', '{$this->RazonSocial}', '{$this->RFC}', '{$this->Direccion}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET Codigo='{$this->Codigo}', Nombre='{$this->Nombre}', RazonSocial='{$this->RazonSocial}', RFC='{$this->RFC}', Direccion='{$this->Direccion}' WHERE IdHotel='{$this->IdHotel}'";
		Executor::doit($sql);
	}

	public static function getRanges($i, $q, $ord = 'id'){
        $sql = "SELECT h.*
				FROM ".self::$tablename." as h ORDER BY h.{$ord} LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

}
