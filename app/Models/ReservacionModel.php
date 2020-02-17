<?php
namespace App\Models;

use App\Config\Executor;

Class ReservacionModel extends Model{
	public $IdReservacion;
	public $Folio;
	public $Fecha;
	public $NumHabitacion;
	public $Descripcion;
	public $Importe;
	public $IdUsuario;
	public $IdHotel;

	function __construct(){
		self::$tablename = 'reservacion';
		$this->Folio='';
		$this->Fecha;
		$this->NumHabitacion='0';
		$this->Descripcion='';
		$this->Importe='0.00';
		$this->IdUsuario;
		$this->IdHotel;
		$this->IdReservacion = '0';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (
		IdReservacion, Folio, Fecha, NumHabitacion, Descripcion, Importe,IdUsuario,IdHotel
		) VALUES 
		('0','{$this->Folio}','{$this->Fecha}','{$this->NumHabitacion}','{$this->Descripcion}','{$this->Importe}','".$_SESSION['IdUser']."','".$_SESSION['IdHotel']."')";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET Folio='{$this->Folio}', Fecha='{$this->Fecha}', NumHabitacion='{$this->NumHabitacion}', Descripcion='{$this->Descripcion}', Importe='{$this->Importe}' WHERE 	
			IdReservacion='{$this->IdReservacion}'";
			Executor::doit($sql);
	}

	public static function getRanges($i,$q,$ord = 'id'){
		$sql = "Select r.* from ".self::$tablename." as r  ORDER BY r.{$ord} LIMIT {$i}, {$q}";
		$query = Executor::doit($sql);
		return self::many($query[0]);
	}
}
?>