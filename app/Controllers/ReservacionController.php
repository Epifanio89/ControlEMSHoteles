<?php

namespace App\Controllers;

use App\Models\ReservacionModel;

class ReservacionController{
	public function index() {
      $reserva = new ReservacionModel();
      $reservaciones = $reserva->getAll('IdReservacion');

		 return view('Catalogos/Reservacion.twig', ['reservaciones' => $reservaciones, 'modelo' => 'Reservacion']);
    }

    public function save(){
          $reg = new ReservacionModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'IdReservacion');
          }

          $reg->Folio = $_POST['Folio'];
          $reg->Fecha = $_POST['Fecha'];
          $reg->IdHabitacion = $_POST['IdHabitacion'];
          $reg->Nombre = $_POST['Nombre'];
          $reg->NPersonas = $_POST['NPersonas'];
          $reg->Efectivo = $_POST['Efectivo'];
          $reg->TPVArcos = $_POST['TPVArcos'];
          $reg->TPVReal = $_POST['TPVReal'];
          $reg->Depositos = $_POST['Depositos'];
          $reg->Commerce = $_POST['Commerce'];
          $reg->Guia = $_POST['Guia'];
          $reg->Descripcion = $_POST['Descripcion'];
          //$reg->IdUsuario = 1;
          //$reg->IdHotel = 1;
          $reg->IdReservacion = $_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }

          redirect('cpanel/reservacion');
  	}

    public function del(){
  	    $reserva = new ReservacionModel();
          $reserva->delById($_POST['id'],'IdReservacion');
          redirect('cpanel/reservacion');
  	}
}
