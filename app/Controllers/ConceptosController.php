<?php

namespace App\Controllers;

use App\Models\ConceptosModel;

class ConceptosController{
	public function index() {
      $concepto = new ConceptosModel();
      $conceptos = $concepto->getAll('IdConcepto');

		 return view('Catalogos/concepto.twig', ['conceptos' => $conceptos, 'modelo' => 'Conceptos']);
    }

    public function save(){
          $reg = new ConceptosModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'IdConcepto');
          }

          $reg->Codigo = $_POST['Codigo'];
          $reg->Nombre = $_POST['Nombre'];
          $reg->IdConcepto = $_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }

          redirect('cpanel/conceptos');
  	}

    public function del(){
  	    $concepto = new ConceptosModel();
          $concepto->delById($_POST['id'],'IdConcepto');

          redirect('cpanel/conceptos');
  	}
}
