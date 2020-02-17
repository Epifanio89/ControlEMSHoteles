<?php

namespace App\Controllers;

use App\Models\SeleccionModel;

class SeleccionController {

    public function index() {
      $select = new SeleccionModel();
      $select = $select->getEmpresas($_SESSION['IdUser']);
      return view('seleccion.twig', ['name' => $select]);
    }

    public function select() {
        $_SESSION['IdHotel'] = input('IdHotel');
        redirect('cpanel/home');
    }

}
