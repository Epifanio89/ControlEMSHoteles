<?php

require_once "vendor/autoload.php";
require_once 'app/Lib/PhpExcel/PHPExcel/IOFactory.php';

use App\Router\Router;

$r = new Router();

echo $r->run();
