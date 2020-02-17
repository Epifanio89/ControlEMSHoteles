<?php

namespace App\Models;

use App\Config\Executor;

class ModulosModel extends Model {
	public $IdModuloxUsuario;
	public $IdModulo;
	public $IdUsuario;
	public $NombreUser;
	public $NombreMod;
	public $Ruta;
	public $Principal;
	public $Icon;

	function __construct(){
		self::$tablename = 'modulos_usuario';
		$this->IdModuloxUsuario = '';
		$this->IdModulo = '';
		$this->IdUsuario = '';
		$this->NombreUser = '';
		$this->NombreMod = '';
		$this->Ruta = '';
		$this->Principal = '';
		$this->Icon = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdModuloxUsuario, IdModulo, IdUsuario) VALUES ('0', '{$this->IdModulo}', '{$this->IdUsuario}')";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET IdModulo='{$this->IdModulo}', IdUsuario='{$this->IdUsuario}' WHERE IdModuloxUsuario = {$this->IdModuloxUsuario}";
		Executor::doit($sql);
	}


	public function getModulos(){
		$sql="SELECT * FROM modulos ORDER BY IdModulo";
		$query = Executor::doit($sql);

		return self::many($query[0]);
	}

	public function getModulosxUsuario(){
		$sql="SELECT mu.*,
			(SELECT m.Nombre FROM modulos as m WHERE m.IdModulo = mu.IdModulo ) as NombreMod,
			(SELECT u.NombreUser FROM usuarios as u WHERE u.IdUser = mu.IdUsuario ) as NombreUser
			FROM modulos_usuario as mu
			ORDER BY mu.IdModuloxUsuario";
		$query = Executor::doit($sql);

		return self::many($query[0]);
	}

	public function getSearchs($id = 'IdUsuario',$field){
		$sql="SELECT mu.*,
					u.NombreUser,m.Nombre as NombreMod
					FROM modulos_usuario as mu
					INNER JOIN modulos as m on (m.IdModulo = mu.IdModulo)
					INNER JOIN usuarios as u on (u.IdUser = mu.IdUsuario)
					WHERE {$id} like '%{$field}%'";
		$query = Executor::doit($sql);

		return self::many($query[0]);
	}

	public function getByIdMod($id = 'id',$field){
		$sql="SELECT mu.*,
					u.NombreUser,m.Nombre as NombreMod
					FROM modulos_usuario as mu
					INNER JOIN modulos as m on (m.IdModulo = mu.IdModulo)
					INNER JOIN usuarios as u on (u.IdUser = mu.IdUsuario)
					WHERE {$field} = {$id} ";
	 	$query = Executor::doit($sql);

		return self::one($query[0]);
	}

	public function getModulosUser($field='IdUsuario',$id){
		$sql="SELECT mu.*,u.NombreUser,m.Nombre as NombreMod,
					m.Ruta,m.Principal,m.Icon
					FROM modulos_usuario as mu
					INNER JOIN modulos as m on (m.IdModulo = mu.IdModulo)
					INNER JOIN usuarios as u on (u.IdUser = mu.IdUsuario)
					WHERE {$field} = {$id}";
		$query = Executor::doit($sql);

		return self::many($query[0]);
	}

}
