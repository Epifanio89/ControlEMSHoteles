<?php

namespace App\Models;

use App\Config\Executor;

class SeleccionModel extends Model {
	public $IdUsuarioHotel;
	public $IdUsuario;
	public $IdHotel;
	public $Nombre;

	function __construct(){
		self::$tablename = 'usuarioxhotel';
		$this->IdUsuarioHotel = '';
		$this->IdUsuario = '';
		$this->IdHotel='';
		$this->Nombre = '';
	}
	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdUser, NombreUser, password, Nombres, Apellidos, email , id_tipo_usuario) VALUES ('0', '{$this->NombreUser}', AES_ENCRYPT('{$this->password}','Quetzalcoatl'), '{$this->Nombres}', '{$this->Apellidos}', '{$this->email}', '{$this->id_tipo_usuario}')";

		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET NombreUser='{$this->NombreUser}',
		password=AES_ENCRYPT('{$this->password}','Quetzalcoatl'), Nombres='{$this->Nombres}',
		Apellidos='{$this->Apellidos}', email='{$this->email}', id_tipo_usuario='{$this->id_tipo_usuario}' WHERE IdUser = {$this->IdUser}";
		Executor::doit($sql);
	}
	public static function getEmpresas($Id=''){
        $sql = "SELECT u.*,(SELECT h.Nombre FROM hotel as h WHERE h.IdHotel = u.IdHotel ) as Nombre
				FROM ".self::$tablename." as u WHERE u.IdUsuario = $Id";
        $query = Executor::doit($sql);
        return self::many($query[0]);
    }
}
