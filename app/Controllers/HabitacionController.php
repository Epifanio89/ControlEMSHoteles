<?php

namespace App\Controllers;
use App\Models\HabitacionModel;

class HabitacionController{
	public function index() {
			$Habitacion = new HabitacionModel();
			$Habitaciones = $Habitacion->getHabitaciones('IdHabitacion');

		 return view('Catalogos/habitacion.twig', ['habitacion' => $Habitaciones, 'modelo' => 'Habitacion']);
		}

		public function save(){
					$reg = new HabitacionModel();
					$reg->Nombre = $_POST['Nombre'];
					$reg->Descripcion = $_POST['Descripcion'];
					$reg->Habitaciones = $_POST['Num'];
					$reg->IdHabitacion = $_POST['id'];
					$reg->IdHotel = $_POST['IdHotel'];


					if($_POST['id'] == 0){
							$reg->add();
					} else{
							$reg->update();
					}

					redirect('cpanel/habitacion');
		}

		public function del(){
				$Habitacion = new HabitacionModel();
					$Habitacion->delById($_POST['id'],'IdHabitacion');

					redirect('cpanel/habitacion');
		}
}
