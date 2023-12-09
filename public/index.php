<?php
require_once __DIR__.'/../cfg.php';
// rota
if(!isCli()){
	$routes->load(realpath(__DIR__.'/../routes.php'));	
}