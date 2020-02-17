<?php
namespace App\Controllers;
use App\Models\ModulosModel;

class ModulosController{
	public function index() {
      $Modu = new ModulosModel();
      $Modulos = $Modu->getModulosxUsuario();

		 return view('Catalogos/modulos.twig', ['modulos' => $Modulos, 'modelo' => 'Modulos']);
    }

    public function save(){
          $Modu = new ModulosModel();

          $Modu->IdModulo = $_POST['IdModulo'];
          $Modu->IdUsuario = $_POST['IdUsuario'];
          $Modu->IdModuloxUsuario = $_POST['id'];

          if($_POST['id'] == 0){
              $Modu->add();
          } else{
              $Modu->update();
          }

          redirect('cpanel/Modulos');
  	}

    public function del(){
  	    $Modu = new ModulosModel();
        $Modu->delById($_POST['id'],'IdModuloxUsuario');

        redirect('cpanel/Modulos');
  	}


}
