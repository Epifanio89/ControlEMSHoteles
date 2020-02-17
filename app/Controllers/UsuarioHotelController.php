<?php
namespace App\Controllers;
use App\Models\UsuarioHotelModel;

class UsuarioHotelController{
	public function index() {
      $usehot = new UsuarioHotelModel();
      $UsuarioHotel = $usehot->getRanges();

		 return view('Catalogos/AsignaHotel.twig', ['UsuarioHotel' => $UsuarioHotel, 'modelo' => 'UsuarioHotel']);
    }

    public function save(){
          $reg = new UsuarioHotelModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'IdUsuarioHotel');
          }

          $reg->IdUsuario = $_POST['IdUsuario'];
          $reg->IdHotel = $_POST['IdHotel'];
          $reg->IdUsuarioHotel = $_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }

          redirect('cpanel/asignahotel');
  	}

    public function del(){
  	    $usuhot = new UsuarioHotelModel();
        $usuhot->delById($_POST['id'],'IdUsuarioHotel');
        redirect('cpanel/asignahotel');
  	}
}
