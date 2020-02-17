<?php

namespace App\Controllers;
use App\Models\PagoModel;

class HomeController{
	public function index() {
		$Pago = new PagoModel();
		$Pagos = $Pago->getRanges(0, 10,'IdPago');
		$c = $Pago->getAll('IdPago');
		$p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);
		 return view('Catalogos/inicio.twig', ['pago' => $Pagos, 'modelo' => 'home', 'pag' => $p]);
    }

		public function save(){
					$reg = new PagoModel();
					if($_POST['id'] != 0){
							$reg = $reg->getById($_POST['id'],'IdPago');
					}
					$reg->Concepto=$_POST['Concepto'];
					$reg->IdCliente=$_POST['Cliente'];
					$reg->IdPrestamo=$_POST['IdPrestamo'];
					$reg->Total=$_POST['Importe'];
					$reg->Fecha=$_POST['Fecha'];
					$reg->Folio=$_POST['Folio'];
					$reg->IdPago=$_POST['id'];

					if($_POST['id'] == 0){
							$reg->add();
					} else{
							$reg->update();
					}

					redirect('cpanel/home');
		}

		public function del(){
				$concepto = new PagoModel();
					$concepto->delById($_POST['id'],'IdPago');

					redirect('cpanel/home');
		}
}
