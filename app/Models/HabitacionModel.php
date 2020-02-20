<?php

namespace App\Models;

use App\Config\Executor;

class HabitacionModel extends Model {
	public $IdHabitacion;
	public $IdHotel;
	public $Nombre;
	public $Habitaciones;
	public $Descripcion;
	public $Hotel;

	function __construct(){
		self::$tablename = 'habitaciones';
		$this->IdHabitacion = '0';
		$this->IdHotel = '0';
		$this->Nombre = '';
		$this->Habitaciones = '';
		$this->Descripcion = '';
		$this->Hotel = '';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (IdHabitacion, IdHotel, Nombre, Habitaciones, Descripcion) VALUES (0, {$this->IdHotel}, '{$this->Nombre}', {$this->Habitaciones}, '{$this->Descripcion}')";
		$sql = Executor::doit($query);

		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET  IdHotel = {$this->IdHotel}, Nombre = '{$this->Nombre}', Habitaciones = {$this->Habitaciones}, Descripcion = '{$this->Descripcion}' WHERE IdHabitacion = {$this->IdHabitacion}";
		Executor::doit($sql);
	}

	public function getHabitaciones(){
		$sql="SELECT h.*, (SELECT t.Nombre FROM hotel as t WHERE t.IdHotel = h.IdHotel ) as Hotel FROM habitaciones as h";
		$query = Executor::doit($sql);

		return self::many($query[0]);
	}

	public function getHabitacionxUser($id){
		$sql="select h.IdHabitacion,h.Nombre from habitaciones as h
		inner join usuarioxhotel as u on (u.IdHotel = h.IdHotel) where u.IdUsuario = {$id}";
		$query = Executor::doit($sql);

		return self::many($query[0]);
	}

}
