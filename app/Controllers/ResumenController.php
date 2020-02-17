<?php

namespace App\Controllers;

use App\Models\ResumenModel;

class ResumenController{
	public function index() {
      $resum= new ResumenModel();
			$resume = $resum->getResumen();
			$fecha = date('d-m-Y');
		 return view('Catalogos/resumen.twig',['resumen' => $resume,'modelo' => 'resumen']);
    }

}
