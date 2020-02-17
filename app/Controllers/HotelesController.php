<?php
namespace App\Controllers;
use App\Models\HotelesModel;

class HotelesController{
	public function index() {
      $hotel = new HotelesModel();
      $hoteles = $hotel->getAll('IdHotel');

		 return view('Catalogos/hotel.twig', ['hoteles' => $hoteles, 'modelo' => 'Hoteles']);
    }

    public function save(){
          $reg = new HotelesModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'IdHotel');
          }

          $reg->Codigo = $_POST['Codigo'];
          $reg->Nombre = $_POST['Nombre'];
          $reg->RazonSocial = $_POST['RazonSocial'];
          $reg->Rfc = $_POST['Rfc'];
          $reg->Direccion = $_POST['Direccion'];
          $reg->IdHotel = $_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }
          redirect('cpanel/hoteles');
  	}

    public function del(){
  	    $perfil = new HotelesModel();
        $perfil->delById($_POST['id'],'IdHotel');

        redirect('cpanel/hoteles');
  	}


}
