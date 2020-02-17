<?php

namespace App\Controllers;

use App\Models\PrestamoModel;

class PrestamoController{
	public function index() {
      $Prestamo = new PrestamoModel();
      $Prestamos = $Prestamo->getAll('IdPrestamo');

		 return view('Catalogos/prestamo.twig', ['Prestamo' => $Prestamos, 'modelo' => 'Prestamo']);
    }

    public function save(){
          $reg = new PrestamoModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'IdPrestamo');
          }
					$reg->Concepto=$_POST['Concepto'];
					$reg->IdCliente=$_POST['Cliente'];
					$reg->Importe=$_POST['Importe'];
					$reg->Fecha=$_POST['Fecha'];
					$reg->Folio=$_POST['Folio'];
					$reg->IdPrestamo=$_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }

          redirect('cpanel/prestamo');
  	}

    public function del(){
  	    $concepto = new PrestamoModel();
          $concepto->delById($_POST['id'],'IdPrestamo');

          redirect('cpanel/prestamo');
  	}
}
