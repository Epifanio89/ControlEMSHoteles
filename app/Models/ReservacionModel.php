<?php
namespace App\Models;

use App\Config\Executor;

Class ReservacionModel extends Model{
	public $IdReservacion;
	public $Folio;
	public $Fecha;
	public $IdHabitacion;
	public $Nombre;
	public $NPersonas;
	public $Efectivo;
	public $TPVArcos;
	public $TPVReal;
	public $Commerce;
	public $Depositos;
	public $Guia;
	public $Descripcion;
	public $IdUsuario;
	public $IdHotel;

	function __construct(){
		self::$tablename = 'reservacion';
		$this->Folio='';
		$this->Fecha;
		$this->IdHabitacion='0';
		$this->Nombre='';
		$this->NPersonas='0';
		$this->Efectivo='0.00';
		$this->TPVArcos='0.00';
		$this->TPVReal='0.00';
		$this->Commerce='0.00';
		$this->Depositos='0.00';
		$this->Guia ='';
		$this->Descripcion='';
		$this->IdUsuario;
		$this->IdHotel;
		$this->IdReservacion = '0';
	}

	public function add(){
		$query = "INSERT INTO ".self::$tablename." (
		IdReservacion, Folio, Fecha, IdHabitacion, Nombre, NPersonas, Efectivo, TPVArcos, TPVReal, Commerce, Depositos, Guia, Descripcion, IdUsuario,IdHotel
		) VALUES 
		('0',
			'{$this->Folio}',
			'{$this->Fecha}',
			'{$this->IdHabitacion}',
			'{$this->Nombre}',
			'{$this->NPersonas}',
			'{$this->Efectivo}',
			'{$this->TPVArcos}',
			'{$this->TPVReal}',
			'{$this->Commerce}',
			'{$this->Depositos}',
			'{$this->Guia}',
			'{$this->Descripcion}',
			'".$_SESSION['IdUser']."',
			'".$_SESSION['IdHotel']."')";
		$sql = Executor::doit($query);
		return $sql[1];
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET 
					Folio='{$this->Folio}', 
					Fecha='{$this->Fecha}', 
					IdHabitacion='{$this->IdHabitacion}', 
					Nombre='{$this->Nombre}',
					NPersonas='{$this->NPersonas}',
					Efectivo='{$this->Efectivo}',
					TPVArcos='{$this->TPVArcos}',
					TPVReal='{$this->TPVReal}',
					Commerce='{$this->Commerce}',
					Depositos='{$this->Depositos}',
					Guia='{$this->Guia}',
					Descripcion='{$this->Descripcion}' 
					WHERE 	
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