<?php

namespace App\Models;

use App\Config\Executor;

class UsuarioHotelModel extends Model {
	public $IdUsuario;
	public $IdHotel;
	public $IdUsuarioHotel;
	public $Usuario;
	public $Hotel;
	public $NombreUsuario;

	function __construct(){
		self::$tablename = 'usuarioxhotel';
		$this->IdUsuario = '0';
		$this->IdHotel = '0';
		$this->IdUsuarioHotel = '0';
		$this->Usuario = '';
		$this->Hotel   = '';
		$this->NombreUsuario = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdUsuarioHotel, IdUsuario, IdHotel) VALUES ('0', '{$this->IdUsuario}', '{$this->IdHotel}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET IdUsuario='{$this->IdUsuario}', IdHotel='{$this->IdHotel}' WHERE IdUsuarioHotel='{$this->IdUsuarioHotel}'";
		Executor::doit($sql);
	}

	public static function getRanges(){
        $sql = "SELECT hu.*, u.NombreUser as Usuario, CONCAT(u.Apellidos,', ',u.Nombres) as NombreUsuario, h.Nombre as Hotel
				FROM ".self::$tablename." as hu
					inner join usuarios u on u.IdUser=hu.IdUsuario
					left join hotel h on h.IdHotel= hu.IdHotel ";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }

    public static function getSearchs($field, $key, $ord = 'id'){
        $sql = "SELECT hu.*, u.NombreUser as Usuario, CONCAT(u.Apellidos,', ',u.Nombres) as NombreUsuario,
        			h.Nombre as Hotel FROM ".self::$tablename." as hu
					inner join usuarios u on u.IdUser=hu.IdUsuario
					left join hotel h on h.IdHotel= hu.IdHotel  WHERE u.{$field} LIKE '%{$key}%' ORDER BY {$ord} LIMIT 0, 25";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }
}
