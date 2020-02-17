<?php

namespace App\Models;

use App\Config\Executor;

class ConceptosModel extends Model {
	public $Codigo;
	public $Nombre;
	public $IdConcepto;

	function __construct(){
		self::$tablename = 'conceptos';
		$this->Codigo = '';
		$this->Nombre = '';
		$this->IdConcepto = '0';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdConcepto, Codigo, Nombre) VALUES ('0', '{$this->Codigo}', '{$this->Nombre}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET Codigo='{$this->Codigo}', Nombre='{$this->Nombre}' WHERE IdConcepto='{$this->IdConcepto}'";
		Executor::doit($sql);
	}

}
