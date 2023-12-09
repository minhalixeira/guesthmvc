<?php
require_once 'cfg.php';
if($routes->segment(1)=='/'){
	header('Location: '.$_ENV['SITE_URL']);
	die();
}else{
	require __DIR__.'/public/index.php';
	die();
}