<?php
require_once __DIR__.'/../cfg.php';	
use gaucho\routes;
$routes=new routes();
$routes->load(realpath(__DIR__.'/../routes.php'));