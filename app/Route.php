<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
            ['url' => '/', 	        						'ctrl' => 'AuthController@index', 						    'type' => 'guest'],
            ['url' => 'cpanel', 							'ctrl' => 'AuthController@index', 						    'type' => 'guest'],

            ['url' => 'cpanel/login', 						'ctrl' => 'AuthController@index', 						    'type' => 'guest'],
            ['url' => 'login', 						        'ctrl' => 'AuthController@index', 						    'type' => 'guest'],


            ['url' => 'cpanel/home',					    'ctrl' => 'homeController@index',	    				'type' => 'admin'],
            ['url' => 'cpanel/home/save',				'ctrl' => 'homeController@save',	    					'type' => 'admin'],
            ['url' => 'cpanel/home/del',				    'ctrl' => 'homeController@del',  						'type' => 'admin'],

  			   ['url' => 'cpanel/conceptos',					    'ctrl' => 'ConceptosController@index',	    				'type' => 'admin'],
  			   ['url' => 'cpanel/conceptos/save',				'ctrl' => 'ConceptosController@save',	    					'type' => 'admin'],
           ['url' => 'cpanel/conceptos/del',				    'ctrl' => 'ConceptosController@del',  						'type' => 'admin'],

           ['url' => 'cpanel/cliente',					    'ctrl' => 'ClienteController@index',	    				'type' => 'admin'],
  			   ['url' => 'cpanel/cliente/save',				'ctrl' => 'ClienteController@save',	    					'type' => 'admin'],
           ['url' => 'cpanel/cliente/del',				    'ctrl' => 'ClienteController@del',  						'type' => 'admin'],

           ['url' => 'cpanel/resumen',					    'ctrl' => 'ResumenController@index',	    				'type' => 'admin'],

           ['url' => 'cpanel/prestamo',					    'ctrl' => 'PrestamoController@index',	    				'type' => 'admin'],
  			   ['url' => 'cpanel/prestamo/save',				'ctrl' => 'PrestamoController@save',	    					'type' => 'admin'],
           ['url' => 'cpanel/prestamo/del',				    'ctrl' => 'PrestamoController@del',  						'type' => 'admin'],

           ['url' => 'cpanel/perfiles',              'ctrl' => 'PerfilesController@index',              'type' => 'admin'],
           ['url' => 'cpanel/perfiles/save',       'ctrl' => 'PerfilesController@save',               'type' => 'admin'],
           ['url' => 'cpanel/perfiles/del',            'ctrl' => 'PerfilesController@del',              'type' => 'admin'],

           ['url' => 'cpanel/reservacion',              'ctrl' => 'ReservacionController@index',              'type' => 'admin'],
           ['url' => 'cpanel/reservacion/save',       'ctrl' => 'ReservacionController@save',               'type' => 'admin'],
           ['url' => 'cpanel/reservacion/del',            'ctrl' => 'ReservacionController@del',              'type' => 'admin'],

           ['url' => 'cpanel/hoteles',              'ctrl' => 'HotelesController@index',              'type' => 'admin'],
           ['url' => 'cpanel/hoteles/save',       'ctrl' => 'HotelesController@save',               'type' => 'admin'],
           ['url' => 'cpanel/hoteles/del',            'ctrl' => 'HotelesController@del',              'type' => 'admin'],

           ['url' => 'cpanel/usuarios',              'ctrl' => 'UsuariosController@index',              'type' => 'admin'],
           ['url' => 'cpanel/usuarios/save',       'ctrl' => 'UsuariosController@save',               'type' => 'admin'],
           ['url' => 'cpanel/usuarios/del',            'ctrl' => 'UsuariosController@del',              'type' => 'admin'],

           ['url' => 'cpanel/asignahotel',              'ctrl' => 'UsuarioHotelController@index',              'type' => 'admin'],
           ['url' => 'cpanel/usuariohotel/save',       'ctrl' => 'UsuarioHotelController@save',               'type' => 'admin'],
           ['url' => 'cpanel/usuariohotel/del',            'ctrl' => 'UsuarioHotelController@del',              'type' => 'admin'],

           ['url' => 'cpanel/modulos',              'ctrl' => 'ModulosController@index',              'type' => 'admin'],
           ['url' => 'cpanel/modulos/save',       'ctrl' => 'ModulosController@save',               'type' => 'admin'],
           ['url' => 'cpanel/modulos/del',            'ctrl' => 'ModulosController@del',              'type' => 'admin'],


           ['url' => 'cpanel/seleccion', 				'ctrl' => 'SeleccionController@index', 						    'type' => 'admin'],
           ['url' => 'cpanel/seleccion/select', 				'ctrl' => 'SeleccionController@select', 						    'type' => 'admin'],

           ['url' => 'cpanel/logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'admin'],
           ['url' => 'logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'admin'],
    		   ['url' => 'auth', 						        'ctrl' => 'AuthController@login', 				    		'type' => 'admin'],


          ['url' => '404', 					        	'ctrl' => 'ErrorController@error404',		    			'type' => 'guest'],
			    ['url' => '403', 						        'ctrl' => 'ErrorController@error403', 	    				'type' => 'guest']
        );
        return $route;
    }
}
