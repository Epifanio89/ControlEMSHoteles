<?php

namespace App\Middleware;

use App\Auth\Auth;

class Middle{

	protected $auth;
	protected $is_auth;
	public function __construct() {
		$this->auth 	= new Auth();
		$this->is_auth	= $this->auth->isAuth();
	}
	public function register() {
		return array(
			'guest'	=> 'guest',
			'admin'	=> 'admin'
		);
	}
	public function isAuth($val, $dir) {
		$type = $this->register();
		if ($val == 'guest') {
			return;
		} else if($this->auth->isAuth()) {
			$flag = true;
			foreach($type as $k => $v){
			if($k == $val)
						$flag = true;
			}

			if($flag){
				return;
			} else
				redirect('403');
		} else {
			if($dir == '/')
				redirect('login');
			else
				redirect('403');
		}
	}

}
