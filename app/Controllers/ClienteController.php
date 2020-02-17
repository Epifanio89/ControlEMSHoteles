<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController{
	public function index() {
      $cliente = new ClienteModel();
      $clientes = $cliente->getRange(0, 10,'IdCliente');
      $c = $cliente->getAll('IdCliente');
      $p = round(count($c)/10) + (count($c)%10 < 5 ? 1 : 0);

		 return view('Catalogos/cliente.twig', ['clientes' => $clientes, 'modelo' => 'cliente', 'pag' => $p]);
    }

    public function save(){
          $reg = new ClienteModel();
          if($_POST['id'] != 0){
              $reg = $reg->getById($_POST['id'],'IdCliente');
          }

					$reg->Nombres = $_POST['Nombres'];
					$reg->Apellidos = $_POST['Apellidos'];
					$reg->Direccion = $_POST['Direccion'];
					$reg->Telefono = $_POST['Telefono'];
					$reg->Correo = $_POST['Correo'];
					$reg->IdCliente = $_POST['id'];

          if($_POST['id'] == 0){
              $reg->add();
          } else{
              $reg->update();
          }

          redirect('cpanel/cliente');
  	}

    public function del(){
  	    $concepto = new ClienteModel();
          $concepto->delById($_POST['id'],'IdCliente');

          redirect('cpanel/cliente');
  	}
}
