<?php

namespace App\Models;

use App\Config\Executor;

class UsuariosModel extends Model {
	public $IdUser;
	public $NombreUser;
	public $password;
	public $Nombres;
	public $Apellidos;
	public $email;
	public $id_tipo_usuario;
	public $NombreCompleto;
	public $Perfil;

	function __construct(){ 
		self::$tablename = 'usuarios';
		$this->Iduser = '';
		$this->Nombres = '';
		$this->Apellidos='';
		$this->email = ''; 
		$this->password='';
		$this->NombreCompleto='';
		$this->Perfil='';
		$this->id_tipo_usuario = '0';
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
	public static function getRanges($i, $q, $ord = 'id'){
        $sql = "SELECT u.*, concat(u.Nombres,' ', u.Apellidos) as NombreCompleto, tu.descripcion as Perfil 
				FROM ".self::$tablename." as u left JOIN tipo_usuario tu on tu.id_tipo_usuario=u.id_tipo_usuario ORDER BY u.{$ord} LIMIT {$i}, {$q}";
        $query = Executor::doit($sql);			
        return self::many($query[0]);
    }

    public static function getSearchs($field, $key, $ord = 'id'){
        $sql = "SELECT u.*, concat(u.Nombres,' ', u.Apellidos) as NombreCompleto, tu.descripcion as Perfil 
        			FROM ".self::$tablename." as u left JOIN tipo_usuario tu on tu.id_tipo_usuario=u.id_tipo_usuario  WHERE {$field} LIKE '%{$key}%' ORDER BY {$ord} LIMIT 0, 25";
        $query = Executor::doit($sql);
        
        return self::many($query[0]);
    }

    public static function getAlls($ord = 'id'){
        $sql = "SELECT u.*, concat(u.Nombres,' ', u.Apellidos) as NombreCompleto FROM ".self::$tablename." as u ORDER BY {$ord}";
        $query = Executor::doit($sql);

        return self::many($query[0]);
    }
}
