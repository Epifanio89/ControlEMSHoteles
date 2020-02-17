<?php

namespace App\Models;

use App\Config\Executor;

class PerfilesModel extends Model {
	public $codigo;
	public $descripcion;
	public $id_tipo_usuario;

	function __construct(){
		self::$tablename = 'tipo_usuario';
		$this->codigo = '';
		$this->descripcion = '';
		$this->id_tipo_usuario = '0';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (id_tipo_usuario, codigo, descripcion) VALUES ('0', '{$this->codigo}', '{$this->descripcion}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET codigo='{$this->codigo}', descripcion='{$this->descripcion}' WHERE id_tipo_usuario='{$this->id_tipo_usuario}'";
		Executor::doit($sql);
	}

	public static function getRanges($i, $q, $ord = 'id'){
        $sql = "SELECT p.* 
				FROM ".self::$tablename." as p  ORDER BY p.{$ord} LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);
				
        return self::many($query[0]);
    }

}
