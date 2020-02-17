<?php
namespace App\Controllers;
use App\Models\PerfilesModel;

class PerfilesController{
	public function index() {
      $perfil = new PerfilesModel();
      $perfiles = $perfil->getAll('id_tipo_usuario');

		 return view('Catalogos/perfil.twig', ['perfiles' => $perfiles, 'modelo' => 'Perfiles']);
    }

    public function save(){
          $reg = new PerfilesModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'id_tipo_usuario');
          }

          $reg->codigo = $_POST['codigo'];
          $reg->descripcion = $_POST['descripcion'];
          $reg->id_tipo_usuario = $_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }

          redirect('cpanel/perfiles');
  	}

    public function del(){
  	    $perfil = new PerfilesModel();
        $perfil->delById($_POST['id'],'id_tipo_usuario');

        redirect('cpanel/perfiles');
  	}


}
